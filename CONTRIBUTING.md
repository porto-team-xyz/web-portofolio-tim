# Panduan Kontribusi

Terima kasih sudah berkontribusi di **Web Portofolio Tim**. Dokumen ini adalah aturan kerja yang disepakati bersama supaya kolaborasi rapi, mudah ditelusuri, dan semua anggota ikut belajar.

> Dokumen ini boleh diubah. Perubahan aturan dilakukan lewat Pull Request dan disetujui seluruh anggota tim.

## Daftar Isi

1. [Prinsip Dasar](#1-prinsip-dasar)
2. [Alur Kerja Harian](#3-alur-kerja-harian)
3. [Aturan Penamaan Branch](#4-aturan-penamaan-branch)
4. [Aturan Pesan Commit](#5-aturan-pesan-commit)
5. [Aturan Pull Request](#6-aturan-pull-request)
6. [Aturan Code Review](#7-aturan-code-review)
7. [Menangani Merge Conflict](#8-menangani-merge-conflict)
8. [Aturan Khusus Proyek Laravel](#9-aturan-khusus-proyek-laravel)
9. [Komunikasi Tim](#10-komunikasi-tim)

---

## 1. Prinsip Dasar

- **Tidak ada yang push langsung ke `main`.** Semua perubahan masuk lewat Pull Request (dijaga oleh ruleset GitHub).
- **Satu issue = satu branch = satu Pull Request.**
- **PR kecil dan sering** lebih baik daripada PR besar yang menumpuk berhari-hari.
- **`main` harus selalu stabil**, yaitu bisa dijalankan tanpa error.
- **Tidak ada rahasia di repo.** Jangan commit `.env`, password, token, atau kunci API.

---

## 2. Alur Kerja Harian

```
Ambil issue → pull main → buat branch → kerja + commit
   → push → buka PR → review → merge → pull main lagi
```

Langkah rinci:

1. **Ambil issue** dari board GitHub Projects. Pastikan sudah ada nama kamu di _Assignees_. Geser kartu ke **In Progress**.
2. **Sinkronkan `main`** lalu buat branch baru:
   ```bash
   git checkout main
   git pull origin main
   git checkout -b feature/nama-fitur
   ```
3. **Kerjakan dan commit** sedikit-sedikit (lihat [aturan commit](#5-aturan-pesan-commit)).
4. **Push** branch:
   ```bash
   git push -u origin feature/nama-fitur
   ```
5. **Buka Pull Request** di GitHub dan geser kartu ke **In Review**.
6. **Review silang**, perbaiki jika diminta, lalu **merge** setelah approve.
7. **Bersihkan dan sinkronkan la gi:**
   ```bash
   git checkout main
   git pull origin main
   git branch -d feature/nama-fitur
   ```

**Selama mengerjakan branch yang lama**, rutin ambil perubahan terbaru dari `main`:

```bash
git checkout main
git pull origin main
git checkout feature/nama-fitur
git merge main
```

## 3. Aturan Penamaan Branch

Format: `jenis/deskripsi-singkat-dengan-tanda-hubung`

| Jenis       | Kegunaan                               | Contoh                       |
| ----------- | -------------------------------------- | ---------------------------- |
| `feature/`  | Fitur atau tampilan baru               | `feature/section-tim`        |
| `fix/`      | Perbaikan bug                          | `fix/navbar-mobile`          |
| `chore/`    | Konfigurasi, dependency, Docker, CI    | `chore/dockerfile-awal`      |
| `docs/`     | Dokumentasi dan konten                 | `docs/tambah-bio-anggota`    |
| `refactor/` | Merapikan kode tanpa mengubah perilaku | `refactor/kontak-controller` |

Aturan: huruf kecil semua, tanpa spasi, singkat tetapi jelas.

## 4. Aturan Pesan Commit

Kami memakai **Conventional Commits**.

Format: `jenis: deskripsi singkat`

| Jenis      | Kegunaan                                        |
| ---------- | ----------------------------------------------- |
| `feat`     | Menambah fitur                                  |
| `fix`      | Memperbaiki bug                                 |
| `docs`     | Perubahan dokumentasi                           |
| `style`    | Perubahan tampilan/format tanpa mengubah logika |
| `refactor` | Merapikan struktur kode                         |
| `test`     | Menambah atau mengubah test                     |
| `chore`    | Konfigurasi, dependency, Docker, CI             |

**Contoh yang baik:**

```
feat: tambah section tim dengan 3 kartu profil
fix: perbaiki menu navbar yang tidak menutup di HP
docs: tambah cara menjalankan proyek di README
chore: tambah dockerignore
```

**Contoh yang kurang baik:**

```
update
fix bug
asdfgh
perubahan terakhir
```

**Tips:**

- Tulis dalam bentuk perintah singkat, maksimal sekitar 70 karakter.
- Satu commit membahas satu hal. Jangan campur banyak perubahan tak berkaitan.
- Commit lebih baik kecil dan sering.

## 5. Aturan Pull Request

**Judul PR** mengikuti format commit, misalnya `feat: tambah section tim`.

**Isi deskripsi PR** minimal memuat:

```markdown
## Ringkasan

Apa yang diubah dan kenapa.

## Perubahan

- Poin perubahan 1
- Poin perubahan 2

## Cara menguji

1. Langkah untuk mencoba perubahan ini
2. Hasil yang diharapkan

## Screenshot (jika ada perubahan tampilan)

Closes #nomor-issue
```

**Checklist sebelum membuka PR:**

- [ ] Branch sudah di-update dari `main` terbaru
- [ ] Proyek bisa dijalankan tanpa error
- [ ] Tidak ada file rahasia (`.env`, kunci API) yang ikut ter-commit
- [ ] Tidak ada kode percobaan, `dd()`, atau `console.log` yang tertinggal
- [ ] Test yang relevan lolos (`php artisan test`)
- [ ] Deskripsi PR memuat `Closes #nomor-issue`

**Aturan lain:**

- Gunakan **Draft pull request** jika pekerjaan belum selesai tetapi ingin mendapat masukan awal.
- Pembuat PR yang melakukan **merge** setelah mendapat approval.
- Setelah merge, **hapus branch** yang sudah selesai.

## 6. Aturan Code Review

- **Minimal 1 approval** dari anggota lain sebelum merge. Pembuat PR tidak bisa meng-approve PR sendiri.
- **Reviewer bergiliran** (pola melingkar) supaya semua belajar membaca kode orang lain:
  - PR Anggota A → di-review Anggota B
  - PR Anggota B → di-review Anggota C
  - PR Anggota C → di-review Anggota A
  - Jika yang bertugas berhalangan, anggota lain boleh menggantikan.
- **Target waktu review: maksimal 24 jam.** Jika terlambat, pembuat PR boleh mengingatkan di chat.
- Pembuat PR menunjuk reviewer lewat menu _Reviewers_.

**Yang diperiksa reviewer:**

- Apakah perubahan sesuai kriteria selesai di issue?
- Apakah kode mudah dibaca dan penamaannya jelas?
- Apakah ada bug, celah keamanan, atau file yang seharusnya tidak ikut?
- Apakah tampilan rapi di HP dan desktop?
- Apakah sebaiknya dicoba langsung dengan checkout branch-nya?

**Pilihan review di GitHub:**

| Pilihan             | Kapan dipakai                               |
| ------------------- | ------------------------------------------- |
| **Comment**         | Pertanyaan atau masukan ringan              |
| **Request changes** | Ada hal yang wajib diperbaiki sebelum merge |
| **Approve**         | Sudah layak digabung                        |

Jika diminta perbaikan, pembuat PR memperbaiki lalu push lagi ke branch yang sama. PR akan ter-update otomatis. Setelah perubahan baru, approval lama bisa dibatalkan dan perlu review ulang.

## 7. Menangani Merge Conflict

Conflict itu normal, bukan kesalahan. Langkah penyelesaiannya:

1. Ambil `main` terbaru dan gabungkan ke branch kamu:
   ```bash
   git checkout main
   git pull origin main
   git checkout feature/nama-fitur
   git merge main
   ```
2. Buka file yang bertanda conflict di VS Code. Pilih versi yang benar, atau gabungkan keduanya, lalu hapus tanda `<<<<<<<`, `=======`, `>>>>>>>`.
3. Jalankan proyek dan pastikan tidak rusak.
4. Simpan hasilnya:
   ```bash
   git add .
   git commit -m "chore: selesaikan conflict dengan main"
   git push
   ```

**Jika ragu versi mana yang benar, tanya pemilik perubahan lewat chat.** Jangan menebak.

**Cara mengurangi conflict:**

- Satu section = satu file di `resources/views/sections/`.
- Kabari di chat sebelum mengubah file bersama seperti `routes/web.php`, `layouts/app.blade.php`, dan `composer.json`.
- Sering `pull` dari `main`.

## 8. Aturan Khusus Proyek Laravel

- **Struktur view:** layout di `resources/views/layouts/`, tiap section di `resources/views/sections/`.
- **Validasi** selalu dilakukan di sisi server (Form Request atau `$request->validate()`).
- **Form** wajib memakai `@csrf`.
- **Database:** perubahan struktur hanya lewat **migration**. Jangan mengubah database secara manual lalu berharap teman mengikuti.
- **Jangan edit migration lama** yang sudah di-merge. Buat migration baru.
- **Foto/aset** diletakkan di `public/images/` dan dikompres (idealnya di bawah 300 KB per file).
- **Link eksternal** memakai `target="_blank"` dan `rel="noopener noreferrer"`.
- **Test:** tambahkan test untuk logika penting (misalnya form kontak) dan jalankan `php artisan test` sebelum membuka PR.
- **Dependency baru** (Composer/NPM) diumumkan di chat dan dijelaskan alasannya di PR.

## 9. Komunikasi Tim

- **Sync rutin:** 2x seminggu (15-30 menit): apa yang sudah selesai, apa yang akan dikerjakan, apa yang menghambat.
- **Terhambat?** Jangan diam. Tulis di komentar issue atau chat grup, lalu ambil issue lain yang tidak bergantung.
- **Mau mengubah file yang sama dengan teman?** Kabari dulu di chat.
- **Diskusi teknis** sebaiknya dicatat di komentar issue/PR agar bisa ditelusuri nanti.
- **Retrospektif** dilakukan di akhir tiap sprint: apa yang berjalan baik, apa yang perlu diperbaiki, apa yang ingin dipelajari lebih dalam. Peran anggota diputar di sprint berikutnya.

---

## Ringkasan Cepat

```
1. git checkout main && git pull origin main
2. git checkout -b feature/nama-fitur
3. kerja + commit kecil (feat: ..., fix: ...)
4. git push -u origin feature/nama-fitur
5. buka PR + "Closes #nomor"
6. review silang → approve → merge
7. git checkout main && git pull origin main
```

Selamat berkontribusi!
