<?php

namespace App\Http\Controllers;

use App\Models\AdministrationType;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $totalStudents = Student::count();
            $activeStudents = Student::where('status_aktif', 'aktif')->count();
            $totalSubmissions = Submission::count();
            $pendingSubmissions = Submission::where('status', 'menunggu')->count();
            $inProcessSubmissions = Submission::where('status', 'diproses')->count();
            $approvedSubmissions = Submission::where('status', 'disetujui')->count();

            $latestSubmissions = Submission::with(['student', 'administrationType', 'user'])
                ->latest()
                ->take(5)
                ->get();

            $latestStudents = Student::latest()->take(5)->get();

            return view('dashboard.admin', compact(
                'totalStudents',
                'activeStudents',
                'totalSubmissions',
                'pendingSubmissions',
                'inProcessSubmissions',
                'approvedSubmissions',
                'latestSubmissions',
                'latestStudents'
            ));
        }

        if ($user->isStudent()) {
            $student = $user->student;
            $submissionsQuery = Submission::where('user_id', $user->id);

            $totalSubmissions = (clone $submissionsQuery)->count();
            $pendingSubmissions = (clone $submissionsQuery)->where('status', 'menunggu')->count();
            $inProcessSubmissions = (clone $submissionsQuery)->where('status', 'diproses')->count();
            $approvedSubmissions = (clone $submissionsQuery)->where('status', 'disetujui')->count();
            $rejectedSubmissions = (clone $submissionsQuery)->where('status', 'ditolak')->count();

            $mySubmissions = Submission::with(['administrationType'])
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return view('dashboard.student', compact(
                'student',
                'totalSubmissions',
                'pendingSubmissions',
                'inProcessSubmissions',
                'approvedSubmissions',
                'rejectedSubmissions',
                'mySubmissions'
            ));
        }

        $pendingApprovals = Submission::whereIn('status', ['menunggu', 'diproses'])->count();
        $approvedCount = Submission::where('status', 'disetujui')->count();
        $rejectedCount = Submission::where('status', 'ditolak')->count();
        $totalSubmissions = Submission::count();

        $submissionsToReview = Submission::with(['student', 'administrationType', 'user'])
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest()
            ->take(6)
            ->get();

        $statsPerType = AdministrationType::withCount('submissions')
            ->orderBy('submissions_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.approver', compact(
            'pendingApprovals',
            'approvedCount',
            'rejectedCount',
            'totalSubmissions',
            'submissionsToReview',
            'statsPerType'
        ));
    }
}
