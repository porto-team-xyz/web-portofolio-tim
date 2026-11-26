<?php

namespace Tests\Feature;

use App\Models\PesanKontak;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesanKontakTest extends TestCase
{
    use RefreshDatabase;

    public function test_pesan_valid_berhasil_disimpan(): void
    {
        $response = $this->post('/kontak', [
            'nama' => 'Andi',
            'email' => 'andi@gmail.com',
            'pesan' => 'Saya ingin bekerja sama.',
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('pesan_kontak', [
            'nama' => 'Andi',
            'email' => 'andi@gmail.com',
            'pesan' => 'Saya ingin bekerja sama.',
            'status' => 'belum_dibaca',
        ]);
    }

    public function test_pesan_tidak_valid_ditolak(): void
    {
        $response = $this->post('/kontak', [
            'nama' => '',
            'email' => 'email-tidak-valid',
            'pesan' => '',
        ]);

        $response->assertSessionHasErrors([
            'nama',
            'email',
            'pesan',
        ]);

        $this->assertDatabaseCount('pesan_kontak', 0);
    }
}
