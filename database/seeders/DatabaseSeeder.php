<?php

namespace Database\Seeders;

use App\Models\AdministrationType;
use App\Models\Student;
use App\Models\Submission;
use App\Models\SubmissionLog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::create([
            'name' => 'Administrator Tata Usaha',
            'email' => 'admin@pesat.sch.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
        ]);

        $kepsek = User::create([
            'name' => 'Drs. H. Ahmad Sudrajat, M.Pd.',
            'email' => 'kepsek@pesat.sch.id',
            'password' => Hash::make('password'),
            'role' => 'kepala_sekolah',
            'phone' => '081298765432',
        ]);

        $userStudent1 = User::create([
            'name' => 'Madyan Arashy',
            'email' => 'siswa@pesat.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'phone' => '085711223344',
        ]);

        $userStudent2 = User::create([
            'name' => 'Farhan Ramadhan',
            'email' => 'farhan@pesat.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'phone' => '085899887766',
        ]);

        $userStudent3 = User::create([
            'name' => 'Nabila Azzahra',
            'email' => 'nabila@pesat.sch.id',
            'password' => Hash::make('password'),
            'role' => 'siswa',
            'phone' => '081344556677',
        ]);

        $types = [
            [
                'nama_layanan' => 'Surat Keterangan Siswa Aktif',
                'kode_layanan' => 'SK-AKTIF',
                'deskripsi' => 'Surat resmi yang menerangkan bahwa siswa yang bersangkutan tercatat aktif belajar di SMK Informatika Pesat.',
                'persyaratan' => 'Fotokopi Kartu Pelajar dan bukti pembayaran administrasi sekolah terakhir.',
                'estimasi_hari' => 1,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Surat Pengantar Praktik Kerja Lapangan (PKL)',
                'kode_layanan' => 'PKL-MAGANG',
                'deskripsi' => 'Surat permohonan dan pengantar resmi dari sekolah yang ditujukan ke institusi industri/perusahaan mitra untuk kegiatan PKL/magang siswa.',
                'persyaratan' => 'Daftar nama anggota kelompok, surat konfirmasi penerimaan awal dari perusahaan, serta persetujuan Kepala Program Keahlian.',
                'estimasi_hari' => 3,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Legalisir Rapor dan Dokumen Sekolah',
                'kode_layanan' => 'LEGALISIR',
                'deskripsi' => 'Pengesahan salinan rapor, ijazah, atau sertifikat kejuruan dengan stempel basah dan tanda tangan pejabat berwenang.',
                'persyaratan' => 'Membawa berkas rapor/ijazah asli beserta dokumen fotokopi maksimal 5 rangkap.',
                'estimasi_hari' => 2,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Surat Rekomendasi Beasiswa',
                'kode_layanan' => 'REKOM-BEASISWA',
                'deskripsi' => 'Surat rekomendasi resmi dari Kepala Sekolah untuk pengajuan beasiswa prestasi akademik maupun non-akademik.',
                'persyaratan' => 'Sertifikat kejuaraan/prestasi, salinan nilai rapor 2 semester terakhir, dan formulir pendaftaran beasiswa terkait.',
                'estimasi_hari' => 3,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Surat Keterangan Berkelakuan Baik (SKBB)',
                'kode_layanan' => 'SKBB',
                'deskripsi' => 'Surat keterangan kepribadian dan rekam jejak kedisiplinan siswa selama menempuh pendidikan di sekolah.',
                'persyaratan' => 'Rekomendasi dari Guru BK dan Wali Kelas, serta bebas dari catatan poin pelanggaran tata tertib.',
                'estimasi_hari' => 1,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Surat Dispensasi Izin Kegiatan Luar',
                'kode_layanan' => 'DISPENSASI',
                'deskripsi' => 'Surat dispensasi izin mengikuti perlombaan, seminar, atau pelatihan kejuruan di luar lingkungan sekolah.',
                'persyaratan' => 'Surat undangan perlombaan dari penyelenggara dan surat tugas pembimbing.',
                'estimasi_hari' => 1,
                'is_active' => true,
            ],
        ];

        $createdTypes = [];
        foreach ($types as $typeData) {
            $createdTypes[] = AdministrationType::create($typeData);
        }

        $student1 = Student::create([
            'user_id' => $userStudent1->id,
            'nis' => '242510001',
            'nisn' => '0078901234',
            'nama_lengkap' => 'Madyan Arashy',
            'jenis_kelamin' => 'L',
            'kelas' => 'XI RPL 1',
            'jurusan' => 'RPL',
            'tempat_lahir' => 'Bogor',
            'tanggal_lahir' => '2008-05-14',
            'alamat' => 'Jl. Sindang Barang No. 12, Kota Bogor',
            'no_telepon' => '085711223344',
            'status_aktif' => 'aktif',
        ]);

        $student2 = Student::create([
            'user_id' => $userStudent2->id,
            'nis' => '242510002',
            'nisn' => '0078901235',
            'nama_lengkap' => 'Farhan Ramadhan',
            'jenis_kelamin' => 'L',
            'kelas' => 'XI TKJ 2',
            'jurusan' => 'TKJ',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '2008-08-20',
            'alamat' => 'Jl. Pajajaran No. 45, Bogor',
            'no_telepon' => '085899887766',
            'status_aktif' => 'aktif',
        ]);

        $student3 = Student::create([
            'user_id' => $userStudent3->id,
            'nis' => '242510003',
            'nisn' => '0078901236',
            'nama_lengkap' => 'Nabila Azzahra',
            'jenis_kelamin' => 'P',
            'kelas' => 'XI DKV 1',
            'jurusan' => 'DKV',
            'tempat_lahir' => 'Depok',
            'tanggal_lahir' => '2008-02-10',
            'alamat' => 'Jl. Raya Dramaga No. 88, Bogor',
            'no_telepon' => '081344556677',
            'status_aktif' => 'aktif',
        ]);

        $otherStudents = [
            ['nis' => '242510004', 'nisn' => '0078901237', 'nama_lengkap' => 'Rizky Pratama', 'jenis_kelamin' => 'L', 'kelas' => 'XII RPL 1', 'jurusan' => 'RPL', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2007-04-12', 'alamat' => 'Ciawi, Bogor', 'no_telepon' => '081234001', 'status_aktif' => 'aktif'],
            ['nis' => '242510005', 'nisn' => '0078901238', 'nama_lengkap' => 'Salma Aulia', 'jenis_kelamin' => 'P', 'kelas' => 'XII TKJ 1', 'jurusan' => 'TKJ', 'tempat_lahir' => 'Sukabumi', 'tanggal_lahir' => '2007-11-25', 'alamat' => 'Cibinong, Bogor', 'no_telepon' => '081234002', 'status_aktif' => 'aktif'],
            ['nis' => '242510006', 'nisn' => '0078901239', 'nama_lengkap' => 'Wildan Nugraha', 'jenis_kelamin' => 'L', 'kelas' => 'XII DKV 2', 'jurusan' => 'DKV', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2007-09-03', 'alamat' => 'Bogor Barat', 'no_telepon' => '081234003', 'status_aktif' => 'aktif'],
            ['nis' => '242510007', 'nisn' => '0078901240', 'nama_lengkap' => 'Arya Diwangkara', 'jenis_kelamin' => 'L', 'kelas' => 'X RPL 2', 'jurusan' => 'RPL', 'tempat_lahir' => 'Bandung', 'tanggal_lahir' => '2009-01-18', 'alamat' => 'Kedunghalang, Bogor', 'no_telepon' => '081234004', 'status_aktif' => 'aktif'],
            ['nis' => '242510008', 'nisn' => '0078901241', 'nama_lengkap' => 'Siti Nurhaliza', 'jenis_kelamin' => 'P', 'kelas' => 'X TKJ 1', 'jurusan' => 'TKJ', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2009-07-30', 'alamat' => 'Ciomas, Bogor', 'no_telepon' => '081234005', 'status_aktif' => 'aktif'],
            ['nis' => '242510009', 'nisn' => '0078901242', 'nama_lengkap' => 'Bagas Dewantara', 'jenis_kelamin' => 'L', 'kelas' => 'X DKV 1', 'jurusan' => 'DKV', 'tempat_lahir' => 'Tangerang', 'tanggal_lahir' => '2009-03-05', 'alamat' => 'Semplak, Bogor', 'no_telepon' => '081234006', 'status_aktif' => 'aktif'],
            ['nis' => '242510010', 'nisn' => '0078901243', 'nama_lengkap' => 'Zahra Safitri', 'jenis_kelamin' => 'P', 'kelas' => 'XI RPL 2', 'jurusan' => 'RPL', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2008-06-17', 'alamat' => 'Tanah Sareal, Bogor', 'no_telepon' => '081234007', 'status_aktif' => 'aktif'],
            ['nis' => '242510011', 'nisn' => '0078901244', 'nama_lengkap' => 'Rendy Saputra', 'jenis_kelamin' => 'L', 'kelas' => 'XI TKJ 1', 'jurusan' => 'TKJ', 'tempat_lahir' => 'Bekasi', 'tanggal_lahir' => '2008-10-09', 'alamat' => 'Yasmin, Bogor', 'no_telepon' => '081234008', 'status_aktif' => 'aktif'],
            ['nis' => '242510012', 'nisn' => '0078901245', 'nama_lengkap' => 'Clarissa Putri', 'jenis_kelamin' => 'P', 'kelas' => 'XI DKV 2', 'jurusan' => 'DKV', 'tempat_lahir' => 'Bogor', 'tanggal_lahir' => '2008-12-22', 'alamat' => 'Baranangsiang, Bogor', 'no_telepon' => '081234009', 'status_aktif' => 'aktif'],
        ];

        foreach ($otherStudents as $st) {
            Student::create($st);
        }

        $sub1 = Submission::create([
            'nomor_pengajuan' => 'ADM-20260918-A1091',
            'user_id' => $userStudent1->id,
            'student_id' => $student1->id,
            'administration_type_id' => $createdTypes[0]->id,
            'tanggal_pengajuan' => now()->subDays(3)->toDateString(),
            'keperluan' => 'Untuk keperluan pembukaan buku rekening tabungan pelajar di Bank Mandiri.',
            'status' => 'disetujui',
            'catatan_petugas' => 'Surat sudah ditandatangani dan dicap resmi. Dapat diambil di ruang Tata Usaha.',
            'tanggal_selesai' => now()->subDays(1),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub1->id,
            'user_id' => $userStudent1->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru telah dibuat oleh pemohon.',
            'created_at' => now()->subDays(3),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub1->id,
            'user_id' => $kepsek->id,
            'status_sebelumnya' => 'menunggu',
            'status_baru' => 'diproses',
            'catatan' => 'Dokumen persyaratan sedang dalam verifikasi bagian kesiswaan.',
            'created_at' => now()->subDays(2),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub1->id,
            'user_id' => $kepsek->id,
            'status_sebelumnya' => 'diproses',
            'status_baru' => 'disetujui',
            'catatan' => 'Surat sudah ditandatangani dan dicap resmi. Dapat diambil di ruang Tata Usaha.',
            'created_at' => now()->subDays(1),
        ]);

        $sub2 = Submission::create([
            'nomor_pengajuan' => 'ADM-20260920-B3482',
            'user_id' => $userStudent1->id,
            'student_id' => $student1->id,
            'administration_type_id' => $createdTypes[1]->id,
            'tanggal_pengajuan' => now()->subDay()->toDateString(),
            'keperluan' => 'Pengajuan pengantar magang industri ke PT Solusi Teknologi Nusantara.',
            'status' => 'diproses',
            'catatan_petugas' => 'Sedang diverifikasi oleh Kepala Program Keahlian RPL.',
            'tanggal_selesai' => null,
        ]);

        SubmissionLog::create([
            'submission_id' => $sub2->id,
            'user_id' => $userStudent1->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru telah dibuat oleh pemohon.',
            'created_at' => now()->subDay(),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub2->id,
            'user_id' => $kepsek->id,
            'status_sebelumnya' => 'menunggu',
            'status_baru' => 'diproses',
            'catatan' => 'Sedang diverifikasi oleh Kepala Program Keahlian RPL.',
            'created_at' => now()->subHours(6),
        ]);

        $sub3 = Submission::create([
            'nomor_pengajuan' => 'ADM-20260921-C8710',
            'user_id' => $userStudent2->id,
            'student_id' => $student2->id,
            'administration_type_id' => $createdTypes[3]->id,
            'tanggal_pengajuan' => now()->toDateString(),
            'keperluan' => 'Pendaftaran seleksi beasiswa prestasi anak berprestasi tingkat Kota Bogor.',
            'status' => 'menunggu',
            'catatan_petugas' => null,
            'tanggal_selesai' => null,
        ]);

        SubmissionLog::create([
            'submission_id' => $sub3->id,
            'user_id' => $userStudent2->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru telah dibuat oleh pemohon.',
            'created_at' => now()->subHours(2),
        ]);

        $sub4 = Submission::create([
            'nomor_pengajuan' => 'ADM-20260915-D5512',
            'user_id' => $userStudent3->id,
            'student_id' => $student3->id,
            'administration_type_id' => $createdTypes[2]->id,
            'tanggal_pengajuan' => now()->subDays(6)->toDateString(),
            'keperluan' => 'Legalisir sertifikat keahlian desain multimedia untuk portofolio lomba tingkat provinsi.',
            'status' => 'ditolak',
            'catatan_petugas' => 'Berkas pindaian sertifikat buram dan tidak terbaca. Harap ajukan ulang dengan dokumen asli yang jelas.',
            'tanggal_selesai' => now()->subDays(5),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub4->id,
            'user_id' => $userStudent3->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru telah dibuat oleh pemohon.',
            'created_at' => now()->subDays(6),
        ]);

        SubmissionLog::create([
            'submission_id' => $sub4->id,
            'user_id' => $kepsek->id,
            'status_sebelumnya' => 'menunggu',
            'status_baru' => 'ditolak',
            'catatan' => 'Berkas pindaian sertifikat buram dan tidak terbaca. Harap ajukan ulang dengan dokumen asli yang jelas.',
            'created_at' => now()->subDays(5),
        ]);
    }
}
