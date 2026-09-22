 
<!-- SISTEM ADMINISTRASI SEKOLAH — SIAKAD ONLINE -->

Aplikasi web terpadu untuk digitalisasi tata kelola administrasi kesiswaan, permohonan surat keterangan, legalisir, pengantar PKL, dan alur persetujuan (*approval*) berjenjang. Dikembangkan dengan Laravel 12 / PHP 8.5 dan Tailwind CSS dengan konsep desain modern dan bersih mengadopsi antarmuka [SIAKAD Online](https://siakad.online/).


<!-- 1. Masalah Client & Solusi Sistem -->

### Permasalahan Client

   Client (sekolah) memiliki kendala mendasar pada tata kelola operasional administrasi internal yang masih manual, menggunakan spreadsheet terpisah, dokumen kertas, dan belum terintegrasi:

●	Data tersebar & sulit dicari: Data siswa dan arsip permohonan berada di banyak file spreadsheet berbeda, menyulitkan staf Tata Usaha saat mencari riwayat siswa tertentu.
●	Proses persetujuan (approval) manual & lambat: Siswa harus mendatangi ruang guru/TU fisik untuk meminta tanda tangan verifikasi; alur berkas tidak bisa dipantau secara realtime.
●	Ketiadaan kontrol akses (access control): Semua pengguna berpotensi melihat data yang bukan ranah tanggung jawabnya.
●	Riwayat administrasi tidak terlacak (no audit trail): Tidak ada pencatatan sistem mengenai siapa yang memproses, kapan surat disetujui, atau mengapa permohonan ditolak.


### Solusi Sistem

● Database relasional terpusat menghubungkan akun pengguna, profil siswa, master layanan administrasi, berkas pengajuan, dan riwayat status (*audit trail*).
● Fitur pencarian multi-kriteria, penyaringan jurusan (TKJ, RPL, DKV), status siswa, dan penomoran halaman (*pagination*) yang terintegrasi.
● Alur persetujuan berjenjang dengan status jelas: **Menunggu**, **Diproses**, **Disetujui**, atau **Ditolak** disertai catatan resmi verifikator.
● Pembatasan hak akses ketat melalui autentikasi multi-role dan custom middleware.

---

## 2. Role Pengguna & Hak Akses

Role : Administrator TU
Nama Pengguna Demo : Administrator Tata Usaha
Kredensial Login : `admin@pesat.sch.id` / `password`
Hak Akses : • Manajemen penuh CRUD Data Pokok Siswa
            • Manajemen Master Jenis Layanan Surat
            • Pemantauan seluruh pengajuan & riwayat audit trail

Role : Siswa (Pemohon)
Nama Pengguna Demo : Madyan Arashy
Kredensial Login : `siswa@pesat.sch.id` / `password`
Hak Akses : • Melihat profil diri & rekam jejak permohonan 
            • Membuat pengajuan surat baru beserta lampiran
            • Membatalkan pengajuan yang masih berstatus menunggu

Role : Kepsek (Approver) 
Nama Pengguna Demo : Drs. H. Ahmad Sudrajat, M.Pd.
Kredensial Login : `kepsek@pesat.sch.id` / `password`
Hak Akses : • Memeriksa detail kelayakan permohonan surat masuk
            • Memberikan keputusan persetujuan (Approve) atau penolakan (Reject) dengan catatan
            • Melihat rekapitulasi statistik per jenis layanan

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
- **Database**: MySQL 8.4 / PhpMyAdmin 
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
