<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PesanKontak;

class KontakController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data formulir
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'pesan' => ['required', 'string'],
        ]);

        // Simpan pesan ke database
        PesanKontak::create($validated);

        // Kembali dengan pesan sukses
        return back()->with(
            'success',
            'Pesan berhasil dikirim!'
        );
    }
}
