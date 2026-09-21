<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubmissionRequest;
use App\Models\AdministrationType;
use App\Models\Submission;
use App\Models\SubmissionLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubmissionController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = Submission::with(['student', 'administrationType', 'user']);

        if ($user->isStudent()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('q')) {
            $query->search($request->input('q'));
        }

        if ($request->filled('status') || $request->filled('administration_type_id')) {
            $query->filter($request->only(['status', 'administration_type_id']));
        }

        $submissions = $query->latest()->paginate(10)->withQueryString();
        $administrationTypes = AdministrationType::where('is_active', true)->get();

        return view('submissions.index', compact('submissions', 'administrationTypes'));
    }

    public function create(): View|RedirectResponse
    {
        $user = Auth::user();

        if ($user->isStudent() && ! $user->student) {
            return redirect()->route('dashboard')
                ->with('error', 'Profil siswa Anda belum terdaftar oleh admin. Hubungi staf Tata Usaha.');
        }

        $student = $user->student;
        $administrationTypes = AdministrationType::where('is_active', true)->get();

        return view('submissions.create', compact('student', 'administrationTypes'));
    }

    public function store(StoreSubmissionRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $validated = $request->validated();

        $filePath = null;
        if ($request->hasFile('berkas_pendukung')) {
            $filePath = $request->file('berkas_pendukung')->store('berkas_pengajuan', 'public');
        }

        $registrationNumber = 'ADM-'.date('Ymd').'-'.strtoupper(Str::random(5));

        $submission = Submission::create([
            'nomor_pengajuan' => $registrationNumber,
            'user_id' => $user->id,
            'student_id' => $validated['student_id'],
            'administration_type_id' => $validated['administration_type_id'],
            'tanggal_pengajuan' => now()->toDateString(),
            'keperluan' => $validated['keperluan'],
            'berkas_pendukung' => $filePath,
            'status' => 'menunggu',
        ]);

        SubmissionLog::create([
            'submission_id' => $submission->id,
            'user_id' => $user->id,
            'status_sebelumnya' => null,
            'status_baru' => 'menunggu',
            'catatan' => 'Pengajuan baru telah dibuat oleh pemohon.',
        ]);

        return redirect()->route('submissions.show', $submission)
            ->with('status', 'Pengajuan administrasi berhasil dikirim dengan Nomor Registrasi: '.$registrationNumber);
    }

    public function show(Submission $submission): View
    {
        $user = Auth::user();

        if ($user->isStudent() && $submission->user_id !== $user->id) {
            abort(403, 'Anda tidak memiliki hak untuk melihat pengajuan ini.');
        }

        $submission->load(['student', 'administrationType', 'user', 'statusLogs.user']);

        return view('submissions.show', compact('submission'));
    }

    public function destroy(Submission $submission): RedirectResponse
    {
        $user = Auth::user();

        if ($user->isStudent() && ($submission->user_id !== $user->id || $submission->status !== 'menunggu')) {
            abort(403, 'Pengajuan yang sudah diproses tidak dapat dibatalkan.');
        }

        $submission->delete();

        return redirect()->route('submissions.index')
            ->with('status', 'Pengajuan administrasi berhasil dibatalkan / dihapus.');
    }
}
