<?php

namespace App\Http\Controllers;

use App\Models\AdministrationType;
use App\Models\Student;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $totalStudents = Student::count();
        $totalServices = AdministrationType::where('is_active', true)->count();
        $totalCompleted = Submission::where('status', 'disetujui')->count();
        $services = AdministrationType::where('is_active', true)->take(6)->get();

        return view('public.index', compact(
            'totalStudents',
            'totalServices',
            'totalCompleted',
            'services'
        ));
    }

    public function searchStudents(Request $request): View
    {
        $query = Student::query();

        if ($request->filled('q')) {
            $query->search($request->input('q'));
        }

        if ($request->filled('jurusan')) {
            $query->filter(['jurusan' => $request->input('jurusan')]);
        }

        $students = $query->orderBy('nama_lengkap', 'asc')->paginate(9)->withQueryString();

        return view('public.students', compact('students'));
    }

    public function showStudent(Student $student): View
    {
        $student->load(['submissions.administrationType']);

        return view('public.student_detail', compact('student'));
    }

    public function trackSubmission(Request $request): View
    {
        $submission = null;
        $searched = false;

        if ($request->filled('kode')) {
            $searched = true;
            $kode = trim($request->input('kode'));

            $submission = Submission::with(['student', 'administrationType', 'statusLogs.user'])
                ->where('nomor_pengajuan', $kode)
                ->first();
        }

        return view('public.tracking', compact('submission', 'searched'));
    }
}
