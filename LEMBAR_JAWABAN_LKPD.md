# PANDUAN JAWABAN LKPD SUMATIF TENGAH SEMESTER — LARAVEL

**Mata Pelajaran**: Konsentrasi Keahlian Rekayasa Perangkat Lunak (XI RPL)  
**Judul Kasus**: Client Brief 02 — Sistem Administrasi Sekolah  
**Nama Project**: SIAKAD Online — Sistem Administrasi Sekolah Terpadu

---

## TUGAS 01 — ANALISIS CLIENT BRIEF

### 1. Apa masalah utama client?
Client (pihak sekolah) menghadapi kendala dalam tata kelola administrasi internal yang masih dilakukan secara manual dan terfragmentasi di berbagai spreadsheet serta dokumen cetak terpisah. Akibatnya:
1. Petugas Tata Usaha kesulitan mencari data siswa dan arsip permohonan secara cepat.
2. Alur persetujuan (*approval*) surat berjalan lambat dan sulit dipantau progresnya secara realtime.
3. Tidak adanya pembatasan hak akses yang tegas menyebabkan risiko kebocoran data dan tumpang tindih tanggung jawab.
4. Riwayat perubahan status administrasi tidak memiliki jejak audit (*audit trail*) yang dapat dipertanggungjawabkan.

---

### 2. Tentukan 3 Role Pengguna

| Role | Deskripsi | Hak Akses / Tanggung Jawab |
|---|---|---|
| **Administrator TU (Admin)** | Staf Tata Usaha pengelola operasional data administrasi sekolah. | • Mengelola penuh CRUD data pokok siswa.<br>• Mengelola master jenis layanan administrasi dan persyaratan.<br>• Memantau seluruh berkas pengajuan dan jejak audit. |
| **Siswa (Pemohon)** | Peserta didik yang terdaftar aktif di sekolah. | • Melihat profil dan rekam jejak pribadi.<br>• Mengajukan permohonan surat keterangan, PKL, legalisir, dan beasiswa secara mandiri.<br>• Memantau status pengajuan miliknya atau membatalkan pengajuan yang masih menunggu. |
| **Kepala Sekolah (Approver)** | Pimpinan atau Kepala Bagian Kesiswaan yang memiliki wewenang pengesahan dokumen resmi. | • Memeriksa kelengkapan dan keabsahan berkas permohonan masuk.<br>• Menyetujui (*Approve*) atau menolak (*Reject*) permohonan disertai catatan resmi.<br>• Melihat rekapitulasi data dan statistik layanan sekolah. |

---

### 3. Tuliskan Minimal 10 Kebutuhan Fungsional

| No | Kebutuhan Sistem |
|---|---|
| 1 | Sistem dapat melakukan autentikasi pengguna (Login dan Logout) dengan pembedaan role secara dinamis. |
| 2 | Sistem dapat membatasi akses halaman dan aksi antar-role menggunakan Custom Middleware (`EnsureUserHasRole`). |
| 3 | Sistem dapat menampilkan dasbor analitik yang disesuaikan dengan wewenang masing-masing role pengguna. |
| 4 | Sistem dapat menambah, mengubah, melihat detail, dan menghapus (CRUD) data pokok siswa. |
| 5 | Sistem dapat melakukan pencarian data siswa secara realtime berdasarkan kata kunci nama, NIS, NISN, atau kelas. |
| 6 | Sistem dapat menyaring (filter) data siswa berdasarkan jurusan (TKJ, RPL, DKV) dan status keaktifan. |
| 7 | Sistem dapat menampilkan paginasi data siswa yang terintegrasi dengan parameter pencarian dan filter (`withQueryString`). |
| 8 | Sistem menyediakan portal publik direktori siswa dan pelacakan status permohonan via nomor registrasi tanpa perlu login. |
| 9 | Siswa dapat membuat pengajuan layanan administrasi dengan memilih jenis surat, tanggal, keperluan, serta mengunggah dokumen pendukung. |
| 10 | Sistem memvalidasi seluruh input formulir menggunakan FormRequest terpisah dari Controller. |
| 11 | Pimpinan/Approver dapat menindaklanjuti pengajuan dengan mengubah status (Diproses, Disetujui, Ditolak) disertai catatan instruksi. |
| 12 | Sistem secara otomatis mencatat setiap riwayat perubahan status pengajuan ke dalam tabel log (*audit trail*). |

---

## TUGAS 02 — PRODUCT BACKLOG

| No | User Story | Prioritas | Penanggung Jawab |
|---|---|---|---|
| 1 | Sebagai pengguna, saya ingin login dengan email dan password, sehingga saya dapat mengakses fitur sesuai hak akses saya. | High | Back-End Engineer |
| 2 | Sebagai Admin TU, saya ingin menambah data pokok siswa baru, sehingga database kesiswaan selalu mutakhir. | High | Fullstack Developer |
| 3 | Sebagai Admin TU, saya ingin mengubah dan memperbarui profil siswa, sehingga kesalahan data dapat diperbaiki. | High | Fullstack Developer |
| 4 | Sebagai Admin TU, saya ingin menghapus data siswa yang tidak valid, sehingga data tetap akurat dan rapi. | Medium | Back-End Engineer |
| 5 | Sebagai Admin TU dan Pimpinan, saya ingin mencari siswa berdasarkan nama atau NIS, sehingga pencarian berkas lebih efisien. | High | Front-End & Back-End |
| 6 | Sebagai staf sekolah, saya ingin memfilter siswa berdasarkan jurusan (TKJ, RPL, DKV), sehingga mudah mengelompokkan siswa per kompetensi. | High | Fullstack Developer |
| 7 | Sebagai pengguna, saya ingin data siswa disajikan dalam halaman paginasi, sehingga memuat data dalam jumlah besar tetap ringan. | High | Fullstack Developer |
| 8 | Sebagai Admin TU, saya ingin mengelola master jenis administrasi (nama surat, estimasi hari, syarat), sehingga jenis permohonan fleksibel. | Medium | Back-End Engineer |
| 9 | Sebagai Siswa, saya ingin mengajukan surat keterangan aktif atau pengantar PKL, sehingga saya tidak perlu mengantre lama secara fisik. | High | Fullstack Developer |
| 10 | Sebagai Siswa, saya ingin mengunggah berkas persyaratan (PDF/gambar), sehingga verifikator dapat memeriksa kelengkapan secara digital. | Medium | Back-End Engineer |
| 11 | Sebagai Siswa, saya ingin memantau status pengajuan saya (Menunggu, Diproses, Disetujui, Ditolak), sehingga ada kepastian waktu penyelesaian. | High | Front-End Developer |
| 12 | Sebagai Kepala Sekolah, saya ingin meninjau berkas permohonan yang masuk, sehingga saya dapat memverifikasi keabsahan sebelum menandatangani. | High | Fullstack Developer |
| 13 | Sebagai Kepala Sekolah, saya ingin menyetujui atau menolak permohonan disertai catatan resmi, sehingga pemohon mengetahui tindak lanjutnya. | High | Back-End Engineer |
| 14 | Sebagai semua pengguna, saya ingin melihat riwayat status dan kronologi pengajuan, sehingga alur administrasi transparan dan terlacak. | Medium | Back-End Engineer |
| 15 | Sebagai Siswa / Wali Murid, saya ingin melacak status berkas tanpa harus login melalui halaman lacak publik, sehingga sangat praktis diakses. | Medium | Front-End Developer |

---

## TUGAS 03 — SPRINT BACKLOG (MVP)

| No | Task | Prioritas | Penanggung Jawab |
|---|---|---|---|
| 1 | Inisialisasi arsitektur database, migrasi tabel (`users`, `students`, `administration_types`, `submissions`, `submission_logs`), dan seed data awal. | High | Database Designer |
| 2 | Membangun autentikasi login/logout multi-role dan custom middleware otorisasi rute. | High | Back-End Engineer |
| 3 | Mengembangkan CRUD Data Siswa lengkap dengan FormRequest validation (`StoreStudentRequest`, `UpdateStudentRequest`). | High | Back-End Engineer |
| 4 | Mengimplementasikan pencarian, penyaringan jurusan/status, dan pagination pada data siswa. | High | Fullstack Developer |
| 5 | Mengembangkan fitur pembuatan pengajuan surat oleh siswa beserta upload berkas lampiran. | High | Fullstack Developer |
| 6 | Membangun antarmuka verifikasi & approval untuk Kepala Sekolah dengan catatan dan update status berkas. | High | Fullstack Developer |
| 7 | Mengintegrasikan pencatatan otomatis audit trail ke tabel `submission_logs` saat status berubah. | High | Back-End Engineer |
| 8 | Merancang tampilan UI berestetika https://profile.smkpesat.id/ (palet warna `#D7D7D7`, `#303841`, `#CCF900`, `#FE7743`) bebas ikon dan bebas komentar kode. | High | UI/UX & Front-End |
| 9 | Membangun portal publik direktori siswa dan fitur lacak pengajuan publik via kode registrasi. | Medium | Front-End Developer |
| 10 | Menulis Feature Test otomatis untuk memastikan seluruh alur kerja berjalan 100% bebas error. | High | QA Engineer |

---

## TUGAS 04 — DATABASE ARCHITECTURE

### Tabel 1: `users`
- **Fungsi**: Menyimpan akun pengguna untuk autentikasi sistem.
- **Primary Key**: `id` (BIGINT UNSIGNED, Auto Increment)
- **Atribut**: `name` (VARCHAR), `email` (VARCHAR, Unique), `password` (VARCHAR), `role` (ENUM: 'admin', 'siswa', 'kepala_sekolah'), `phone` (VARCHAR, Nullable), `created_at`, `updated_at`.
- **Relasi**: 
  - One-to-One ke tabel `students` (`users.id` -> `students.user_id`).
  - One-to-Many ke tabel `submissions` (`users.id` -> `submissions.user_id`).
  - One-to-Many ke tabel `submission_logs` (`users.id` -> `submission_logs.user_id`).

### Tabel 2: `students`
- **Fungsi**: Menyimpan data induk kesiswaan.
- **Primary Key**: `id` (BIGINT UNSIGNED, Auto Increment)
- **Foreign Key**: `user_id` (BIGINT UNSIGNED, Nullable, References `users.id` ON DELETE SET NULL).
- **Atribut**: `nis` (VARCHAR(20), Unique), `nisn` (VARCHAR(20), Unique), `nama_lengkap` (VARCHAR), `jenis_kelamin` (ENUM: 'L', 'P'), `kelas` (VARCHAR(20)), `jurusan` (ENUM: 'TKJ', 'RPL', 'DKV'), `tempat_lahir` (VARCHAR), `tanggal_lahir` (DATE), `alamat` (TEXT), `no_telepon` (VARCHAR), `status_aktif` (ENUM: 'aktif', 'lulus', 'mutasi', 'non-aktif'), `created_at`, `updated_at`.
- **Relasi**:
  - Many-to-One ke tabel `users` (`students.user_id` -> `users.id`).
  - One-to-Many ke tabel `submissions` (`students.id` -> `submissions.student_id`).

### Tabel 3: `administration_types`
- **Fungsi**: Menyimpan master data jenis permohonan administrasi/surat sekolah.
- **Primary Key**: `id` (BIGINT UNSIGNED, Auto Increment)
- **Atribut**: `nama_layanan` (VARCHAR), `kode_layanan` (VARCHAR(20), Unique), `deskripsi` (TEXT), `persyaratan` (TEXT), `estimasi_hari` (INT), `is_active` (BOOLEAN), `created_at`, `updated_at`.
- **Relasi**:
  - One-to-Many ke tabel `submissions` (`administration_types.id` -> `submissions.administration_type_id`).

### Tabel 4: `submissions`
- **Fungsi**: Menyimpan data transaksi permohonan administrasi yang diajukan siswa.
- **Primary Key**: `id` (BIGINT UNSIGNED, Auto Increment)
- **Foreign Key**: 
  - `user_id` (References `users.id` ON DELETE CASCADE)
  - `student_id` (References `students.id` ON DELETE CASCADE)
  - `administration_type_id` (References `administration_types.id` ON DELETE CASCADE)
- **Atribut**: `nomor_pengajuan` (VARCHAR(30), Unique), `tanggal_pengajuan` (DATE), `keperluan` (TEXT), `berkas_pendukung` (VARCHAR, Nullable), `status` (ENUM: 'menunggu', 'diproses', 'disetujui', 'ditolak'), `catatan_petugas` (TEXT, Nullable), `tanggal_selesai` (TIMESTAMP, Nullable), `created_at`, `updated_at`.
- **Relasi**:
  - Many-to-One ke `users`, `students`, dan `administration_types`.
  - One-to-Many ke tabel `submission_logs` (`submissions.id` -> `submission_logs.submission_id`).

### Tabel 5: `submission_logs`
- **Fungsi**: Menyimpan jejak audit (*audit trail*) setiap kali status pengajuan berubah.
- **Primary Key**: `id` (BIGINT UNSIGNED, Auto Increment)
- **Foreign Key**: 
  - `submission_id` (References `submissions.id` ON DELETE CASCADE)
  - `user_id` (References `users.id` ON DELETE SET NULL)
- **Atribut**: `status_sebelumnya` (VARCHAR(30), Nullable), `status_baru` (VARCHAR(30)), `catatan` (TEXT, Nullable), `created_at`, `updated_at`.
- **Relasi**:
  - Many-to-One ke `submissions` dan `users`.

---

## TUGAS 05 — MEMBUAT ERD (PANDUAN UNTUK GAMBAR MANDIRI)

*Catatan: Sesuai petunjuk LKPD, ERD wajib digambar sendiri oleh siswa menggunakan software diagram (misalnya **draw.io** atau **dbdiagram.io**).*

### Panduan Notasi Kardinalitas ERD:
1. **`users` ke `students`**:
   - Kardinalitas: `1 to (0..1)` (Satu user dapat terhubung ke maksimal satu siswa, dan satu siswa memiliki satu user).
2. **`students` ke `submissions`**:
   - Kardinalitas: `1 to N` (Satu siswa dapat memiliki banyak riwayat pengajuan).
3. **`administration_types` ke `submissions`**:
   - Kardinalitas: `1 to N` (Satu jenis layanan dapat digunakan dalam banyak pengajuan).
4. **`submissions` ke `submission_logs`**:
   - Kardinalitas: `1 to N` (Satu pengajuan memiliki banyak baris riwayat audit log).
5. **`users` ke `submission_logs`**:
   - Kardinalitas: `1 to N` (Satu user/petugas dapat melakukan banyak aksi verifikasi).

---

## TUGAS 06 — IMPLEMENTASI FITUR LARAVEL

1. **Laravel MVC**: Struktur file dipisahkan dengan tertib pada direktori `app/Models`, `resources/views`, dan `app/Http/Controllers`.
2. **Blade Templating**: Menggunakan layout modular `<x-layouts.app>` dan `<x-layouts.guest>`, conditional rendering (`@if`, `@auth`), perulangan (`@foreach`), dan formulir terstruktur.
3. **Authentication**: Menerapkan login, logout, dan remember token menggunakan `Illuminate\Support\Facades\Auth`.
4. **Authorization & Custom Middleware**: Menerapkan middleware `EnsureUserHasRole` dengan alias `role:admin`, `role:siswa`, dan `role:kepala_sekolah` untuk membatasi akses URL secara ketat.
5. **Eloquent ORM & Relasi**: Menggunakan relasi Eloquent lengkap (`hasOne`, `belongsTo`, `hasMany`).
6. **FormRequest Validation**: Validasi terisolasi dari controller menggunakan FormRequest terpisah (`StoreStudentRequest`, `UpdateStudentRequest`, `StoreSubmissionRequest`, `UpdateSubmissionStatusRequest`, `StoreAdministrationTypeRequest`, `UpdateAdministrationTypeRequest`).
7. **Search + Filter + Pagination**: Pada controller `StudentController` dan `PublicController`, kueri database mengintegrasikan scope pencarian teks, dropdown filter jurusan/status, dan method `.paginate(10)->withQueryString()`.
8. **N+1 Query Prevention**: Menggunakan Eager Loading `with(['student', 'administrationType', 'user', 'statusLogs.user'])` untuk memastikan pengambilan data berjalan efisien dalam 1 kali kueri JOIN.

---

## TUGAS 08 — DAFTAR DOKUMENTASI HALAMAN APLIKASI (UNTUK SCREENSHOT)

Saat menyusun laporan screenshot pada lembar jawab tugas 08, sertakan foto halaman berikut beserta keterangannya:

1. **Gambar 1 — Halaman Beranda Publik (`/`)**:
   - *Keterangan*: Halaman utama bertema profil SMK Pesat IT XPRO yang menampilkan informasi program keahlian (TKJ, RPL, DKV), data statistik terkini, dan fitur layanan administrasi.
2. **Gambar 2 — Halaman Lacak Pengajuan Publik (`/lacak-pengajuan`)**:
   - *Keterangan*: Fasilitas pencarian status permohonan surat secara instan menggunakan nomor registrasi pengajuan tanpa perlu login.
3. **Gambar 3 — Halaman Direktori Siswa Publik (`/cari-siswa`)**:
   - *Keterangan*: Tampilan pencarian data siswa publik lengkap dengan filter jurusan dan paginasi.
4. **Gambar 4 — Halaman Masuk Akun (`/login`)**:
   - *Keterangan*: Antarmuka autentikasi pengguna dengan tombol uji coba cepat (*quick-fill*) untuk role Admin, Siswa, dan Approver.
5. **Gambar 5 — Halaman Dasbor Administrator Tata Usaha (`/dashboard`)**:
   - *Keterangan*: Ringkasan analitik jumlah siswa, status pengajuan, serta pintasan aksi untuk staf Tata Usaha.
6. **Gambar 6 — Halaman Kelola Data Siswa (`/students`)**:
   - *Keterangan*: Tabel data induk siswa dengan kontrol search, filter jurusan, filter status aktif, paginasi, dan tombol aksi CRUD.
7. **Gambar 7 — Halaman Formulir Tambah Siswa (`/students/create`)**:
   - *Keterangan*: Formulir penambahan data pokok siswa dengan validasi form terpisah.
8. **Gambar 8 — Halaman Dasbor Siswa Pemohon (`/dashboard`)**:
   - *Keterangan*: Tampilan dasbor siswa yang menampilkan ringkasan pengajuan milik pribadi dan tombol permohonan baru.
9. **Gambar 9 — Halaman Formulir Pengajuan Surat (`/submissions/create`)**:
   - *Keterangan*: Formulir pengajuan permohonan surat oleh siswa dengan deteksi dinamis estimasi waktu dan persyaratan dokumen.
10. **Gambar 10 — Halaman Rincian Pengajuan & Jejak Audit (`/submissions/{id}`)**:
    - *Keterangan*: Tampilan riwayat status berkas lengkap dengan kronologi perubahan status (*audit trail*) dan catatan petugas.
11. **Gambar 11 — Halaman Antrean Approval Pimpinan (`/approvals`)**:
    - *Keterangan*: Halaman verifikasi untuk Kepala Sekolah dengan tab status permohonan Menunggu, Diproses, Disetujui, dan Ditolak.
12. **Gambar 12 — Halaman Keputusan Persetujuan Berkas (`/approvals/{id}`)**:
    - *Keterangan*: Formulir bagi verifikator untuk menentukan keputusan status serta mencantumkan catatan tindak lanjut resmi.
