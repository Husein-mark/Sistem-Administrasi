<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubmissionStatusRequest;
use App\Models\Submission;
use App\Models\SubmissionLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ApprovalController extends Controller
{
    public function index(Request $request): View
    {
        $statusFilter = $request->input('status', 'menunggu');

        $query = Submission::with(['student', 'administrationType', 'user']);

        if ($statusFilter !== 'semua') {
            $query->where('status', $statusFilter);
        }

        if ($request->filled('q')) {
            $query->search($request->input('q'));
        }

        $submissions = $query->latest()->paginate(10)->withQueryString();

        $countPending = Submission::where('status', 'menunggu')->count();
        $countProcess = Submission::where('status', 'diproses')->count();
        $countApproved = Submission::where('status', 'disetujui')->count();
        $countRejected = Submission::where('status', 'ditolak')->count();

        return view('approvals.index', compact(
            'submissions',
            'statusFilter',
            'countPending',
            'countProcess',
            'countApproved',
            'countRejected'
        ));
    }

    public function show(Submission $submission): View
    {
        $submission->load(['student', 'administrationType', 'user', 'statusLogs.user']);

        return view('approvals.show', compact('submission'));
    }

    public function update(UpdateSubmissionStatusRequest $request, Submission $submission): RedirectResponse
    {
        $validated = $request->validated();
        $actor = Auth::user();
        $oldStatus = $submission->status;
        $newStatus = $validated['status'];

        $submission->status = $newStatus;
        $submission->catatan_petugas = $validated['catatan_petugas'] ?? null;

        if (in_array($newStatus, ['disetujui', 'ditolak'], true)) {
            $submission->tanggal_selesai = now();
        } else {
            $submission->tanggal_selesai = null;
        }

        $submission->save();

        SubmissionLog::create([
            'submission_id' => $submission->id,
            'user_id' => $actor->id,
            'status_sebelumnya' => $oldStatus,
            'status_baru' => $newStatus,
            'catatan' => $validated['catatan_petugas'] ?: 'Status diubah menjadi: '.ucfirst($newStatus),
        ]);

        return redirect()->route('approvals.show', $submission)
            ->with('status', 'Status pengajuan berhasil diperbarui menjadi '.strtoupper($newStatus).'.');
    }
}
