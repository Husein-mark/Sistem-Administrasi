# SISTEM ADMINISTRASI SEKOLAH — SIAKAD ONLINE

Aplikasi web terpadu untuk digitalisasi tata kelola administrasi kesiswaan, permohonan surat keterangan, legalisir, pengantar PKL, dan alur persetujuan (*approval*) berjenjang. Dikembangkan dengan Laravel 12 / PHP 8.5 dan Tailwind CSS dengan konsep desain modern dan bersih mengadopsi antarmuka [SIAKAD Online](https://siakad.online/).

---

## 1. Masalah Client & Solusi Sistem

### Permasalahan
- Data administrasi dan rekam jejak kesiswaan sebelumnya tersebar di berbagai spreadsheet dan dokumen cetak terpisah.
- Petugas Tata Usaha kesulitan melakukan pencarian cepat dan penyaringan data siswa per jurusan/kelas.
- Alur persetujuan (*approval*) surat masih dilakukan manual secara fisik sehingga riwayat dan status permohonan sulit dipantau.
- Pengguna sering dapat melihat berkas yang berada di luar batas tanggung jawabnya karena ketiadaan kontrol hak akses (*role access control*).

### Solusi Sistem
- Database relasional terpusat menghubungkan akun pengguna, profil siswa, master layanan administrasi, berkas pengajuan, dan riwayat status (*audit trail*).
- Fitur pencarian multi-kriteria, penyaringan jurusan (TKJ, RPL, DKV), status siswa, dan penomoran halaman (*pagination*) yang terintegrasi.
- Alur persetujuan berjenjang dengan status jelas: **Menunggu**, **Diproses**, **Disetujui**, atau **Ditolak** disertai catatan resmi verifikator.
- Pembatasan hak akses ketat melalui autentikasi multi-role dan custom middleware.

---

## 2. 3 Role Pengguna & Hak Akses

| Role | Nama Pengguna Demo | Kredensial Login | Wewenang & Tanggung Jawab |
|---|---|---|---|
| **Administrator TU** | Administrator Tata Usaha | `admin@pesat.sch.id` / `password` | • Manajemen penuh CRUD Data Pokok Siswa<br>• Manajemen Master Jenis Layanan Surat<br>• Pemantauan seluruh pengajuan & riwayat audit trail |
| **Siswa (Pemohon)** | Madyan Arashy | `siswa@pesat.sch.id` / `password` | • Melihat profil diri & rekam jejak permohonan<br>• Membuat pengajuan surat baru beserta lampiran<br>• Membatalkan pengajuan yang masih berstatus menunggu |
| **Kepala Sekolah (Approver)** | Drs. H. Ahmad Sudrajat, M.Pd. | `kepsek@pesat.sch.id` / `password` | • Memeriksa detail kelayakan permohonan surat masuk<br>• Memberikan keputusan persetujuan (*Approve*) atau penolakan (*Reject*) dengan catatan<br>• Melihat rekapitulasi statistik per jenis layanan |

---

## 3. Fitur Utama

1. **Autentikasi Multi-Role & Custom Middleware**:
   - Middleware `EnsureUserHasRole` memastikan pengguna hanya dapat membuka modul yang diizinkan sesuai perannya.
2. **Pencarian, Filter & Paginasi Data Siswa**:
   - Pencarian kata kunci pada nama, NIS, NISN, dan kelas.
   - Filter dropdown jurusan (TKJ, RPL, DKV) dan status keaktifan.
   - Paginasi 10 data per halaman dengan mempertahankan query string (`withQueryString()`).
3. **Pengajuan Layanan Administrasi Mandiri**:
   - Pemilihan jenis layanan (Surat Keterangan Aktif, Pengantar PKL, Legalisir Dokumen, Rekomendasi Beasiswa, SKBB, Dispensasi).
   - Penomoran otomatis kode pengajuan berformat `ADM-YYYYMMDD-XXXXX`.
   - Unggah berkas pendukung format PDF / gambar.
4. **Alur Approval & Jejak Audit (Audit Trail)**:
   - Pencatatan otomatis ke tabel `submission_logs` setiap kali status permohonan berubah lengkap dengan aktor pengubah dan catatan instruksi.
5. **Portal Publik & Penelusuran Berkas**:
   - Direktori profil siswa publik tanpa login.
   - Halaman pelacakan status berkas publik via nomor registrasi pengajuan.
6. **Optimasi Kueri (Bebas N+1 Query)**:
   - Penerapan Eager Loading Eloquent (`with(['student', 'user', 'administrationType', 'statusLogs.user'])`).

---

## 4. Teknologi yang Digunakan

- **Backend Framework**: Laravel 12 (PHP 8.5)
- **Database**: MySQL 8.4 / SQLite (untuk unit testing)
- **Frontend & Styling**: Blade Templating + Tailwind CSS v4 + Vite
- **Tipografi**: Plus Jakarta Sans (Google Fonts)
- **Desain UI**: Modern Clean SaaS System ([siakad.online](https://siakad.online/)) - Primary Blue `#1B6CF2`, Sky Blue `#0EA5E9`, Slate Gray `#F8FAFC`, Navy `#0F172A`
- **Testing**: PHPUnit 11

---

## 5. Cara Menjalankan Project

### Persyaratan Sistem
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL Server (misal melalui Laragon / XAMPP)

### Langkah Instalasi
1. Clone repositori dan masuk ke direktori proyek:
   ```bash
   cd sistem-administrasi-sekolah
   ```

2. Pasang dependensi PHP dan Node.js:
   ```bash
   composer install
   npm install
   ```

3. Konfigurasi berkas lingkungan:
   Pastikan konfigurasi database di file `.env` sudah mengarah ke database MySQL Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_administrasi_sekolah
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. Jalankan migrasi dan seeder data awal:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. Buat tautan storage untuk berkas lampiran:
   ```bash
   php artisan storage:link
   ```

6. Kompilasi aset frontend:
   ```bash
   npm run build
   ```

7. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
   Akses aplikasi melalui peramban pada alamat: `http://localhost:8000`

---

## 6. Menjalankan Pengujian Otomatis

Jalankan rangkaian tes unit dan fitur dengan perintah:
```bash
php artisan test
```
Semua 11 pengujian fitur (autentikasi, middleware role, CRUD siswa, filter pencarian, submission, approval log, dan tracking publik) terverifikasi lulus 100%.
