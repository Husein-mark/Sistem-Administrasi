<?php

namespace Tests\Feature;

use App\Models\AdministrationType;
use App\Models\Student;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SchoolAdministrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_can_be_accessed(): void
    {
        $this->get(route('home'))->assertStatus(200);
        $this->get(route('public.students'))->assertStatus(200);
        $this->get(route('public.tracking'))->assertStatus(200);
    }

    public function test_user_can_authenticate_and_logout(): void
    {
        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        $response = $this->post(route('login.attempt'), [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);

        $logoutResponse = $this->post(route('logout'));
        $logoutResponse->assertRedirect(route('login'));
        $this->assertGuest();
    }

    public function test_guest_is_redirected_to_login_when_accessing_dashboard(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_role_middleware_restricts_student_from_admin_and_approval_pages(): void
    {
        $studentUser = User::create([
            'name' => 'Siswa Test',
            'email' => 'siswa@test.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        $this->actingAs($studentUser);

        $this->get(route('students.index'))->assertStatus(403);
        $this->get(route('approvals.index'))->assertStatus(403);
        $this->get(route('administration-types.index'))->assertStatus(403);
    }

    public function test_admin_can_crud_student_with_form_request_validation(): void
    {
        $admin = User::create([
            'name' => 'Admin TU',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->actingAs($admin);

        $studentData = [
            'nis' => '11223344',
            'nisn' => '0099887766',
            'nama_lengkap' => 'Ahmad Syarif',
            'jenis_kelamin' => 'L',
            'kelas' => 'XI RPL 1',
            'jurusan' => 'RPL',
            'status_aktif' => 'aktif',
            'tempat_lahir' => 'Bogor',
            'tanggal_lahir' => '2008-01-01',
            'alamat' => 'Bogor Barat',
            'no_telepon' => '0812345678',
        ];

        $storeResponse = $this->post(route('students.store'), $studentData);
        $storeResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('students', ['nis' => '11223344']);

        $student = Student::where('nis', '11223344')->first();

        $updateData = array_merge($studentData, [
            'nama_lengkap' => 'Ahmad Syarif Updated',
            'kelas' => 'XII RPL 1',
        ]);

        $updateResponse = $this->put(route('students.update', $student), $updateData);
        $updateResponse->assertSessionHasNoErrors();
        $this->assertDatabaseHas('students', ['nama_lengkap' => 'Ahmad Syarif Updated', 'kelas' => 'XII RPL 1']);

        $deleteResponse = $this->delete(route('students.destroy', $student));
        $deleteResponse->assertRedirect(route('students.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

    public function test_student_search_filter_and_pagination_works(): void
    {
        Student::create([
            'nis' => '1001',
            'nisn' => '2001',
            'nama_lengkap' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'kelas' => 'X TKJ 1',
            'jurusan' => 'TKJ',
            'status_aktif' => 'aktif',
        ]);

        Student::create([
            'nis' => '1002',
            'nisn' => '2002',
            'nama_lengkap' => 'Citra Lestari',
            'jenis_kelamin' => 'P',
            'kelas' => 'XI RPL 1',
            'jurusan' => 'RPL',
            'status_aktif' => 'aktif',
        ]);

        $responseSearch = $this->get(route('public.students', ['q' => 'Budi']));
        $responseSearch->assertStatus(200);
        $responseSearch->assertSee('Budi Santoso');
        $responseSearch->assertDontSee('Citra Lestari');

        $responseFilter = $this->get(route('public.students', ['jurusan' => 'RPL']));
        $responseFilter->assertStatus(200);
        $responseFilter->assertSee('Citra Lestari');
        $responseFilter->assertDontSee('Budi Santoso');
    }

    public function test_student_can_create_submission_and_log_is_generated(): void
    {
        $studentUser = User::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi@test.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'nis' => '55555',
            'nisn' => '66666',
            'nama_lengkap' => 'Dewi Sartika',
            'jenis_kelamin' => 'P',
            'kelas' => 'XI DKV 1',
            'jurusan' => 'DKV',
            'status_aktif' => 'aktif',
        ]);

        $type = AdministrationType::create([
            'nama_layanan' => 'Surat Keterangan Aktif',
            'kode_layanan' => 'SK-AKTIF',
            'estimasi_hari' => 1,
            'is_active' => true,
        ]);

        $this->actingAs($studentUser);

        $response = $this->post(route('submissions.store'), [
            'student_id' => $student->id,
            'administration_type_id' => $type->id,
            'keperluan' => 'Untuk melamar beasiswa pendidikan kejuruan.',
        ]);

        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('submissions', [
            'student_id' => $student->id,
            'status' => 'menunggu',
        ]);

        $submission = Submission::where('student_id', $student->id)->first();
        $this->assertDatabaseHas('submission_logs', [
            'submission_id' => $submission->id,
            'status_baru' => 'menunggu',
        ]);
    }

    public function test_approver_can_review_and_approve_submission(): void
    {
        $approver = User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepsek@test.com',
            'password' => Hash::make('password'),
            'role' => 'kepala_sekolah',
        ]);

        $studentUser = User::create([
            'name' => 'Fajar Pratama',
            'email' => 'fajar@test.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        $student = Student::create([
            'user_id' => $studentUser->id,
            'nis' => '77777',
            'nisn' => '88888',
            'nama_lengkap' => 'Fajar Pratama',
            'jenis_kelamin' => 'L',
            'kelas' => 'XII RPL 2',
            'jurusan' => 'RPL',
            'status_aktif' => 'aktif',
        ]);

        $type = AdministrationType::create([
            'nama_layanan' => 'Surat Pengantar PKL',
            'kode_layanan' => 'PKL',
            'estimasi_hari' => 3,
            'is_active' => true,
        ]);

        $submission = Submission::create([
            'nomor_pengajuan' => 'ADM-TEST-999',
            'user_id' => $studentUser->id,
            'student_id' => $student->id,
            'administration_type_id' => $type->id,
            'tanggal_pengajuan' => now()->toDateString(),
            'keperluan' => 'Pengantar magang di industri software.',
            'status' => 'menunggu',
        ]);

        $this->actingAs($approver);

        $response = $this->put(route('approvals.update', $submission), [
            'status' => 'disetujui',
            'catatan_petugas' => 'Surat disetujui dan ditandatangani.',
        ]);

        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('submissions', [
            'id' => $submission->id,
            'status' => 'disetujui',
            'catatan_petugas' => 'Surat disetujui dan ditandatangani.',
        ]);

        $this->assertDatabaseHas('submission_logs', [
            'submission_id' => $submission->id,
            'status_sebelumnya' => 'menunggu',
            'status_baru' => 'disetujui',
            'user_id' => $approver->id,
        ]);
    }

    public function test_public_tracking_submission(): void
    {
        $user = User::create([
            'name' => 'Gilang',
            'email' => 'gilang@test.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'nis' => '99991',
            'nisn' => '99992',
            'nama_lengkap' => 'Gilang Ramadhan',
            'jenis_kelamin' => 'L',
            'kelas' => 'X TKJ 2',
            'jurusan' => 'TKJ',
            'status_aktif' => 'aktif',
        ]);

        $type = AdministrationType::create([
            'nama_layanan' => 'Legalisir Ijazah',
            'kode_layanan' => 'LEGALISIR-TEST',
            'estimasi_hari' => 2,
            'is_active' => true,
        ]);

        $submission = Submission::create([
            'nomor_pengajuan' => 'ADM-TRACK-12345',
            'user_id' => $user->id,
            'student_id' => $student->id,
            'administration_type_id' => $type->id,
            'tanggal_pengajuan' => now()->toDateString(),
            'keperluan' => 'Pemberkasan seleksi perguruan tinggi.',
            'status' => 'disetujui',
        ]);

        $response = $this->get(route('public.tracking', ['kode' => 'ADM-TRACK-12345']));
        $response->assertStatus(200);
        $response->assertSee('ADM-TRACK-12345');
        $response->assertSee('Gilang Ramadhan');
        $response->assertSee('Disetujui');
    }
}
