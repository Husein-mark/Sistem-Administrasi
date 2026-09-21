<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Student::with(['user']);

        if ($request->filled('q')) {
            $query->search($request->input('q'));
        }

        if ($request->filled('jurusan') || $request->filled('status_aktif') || $request->filled('kelas')) {
            $query->filter($request->only(['jurusan', 'status_aktif', 'kelas']));
        }

        $students = $query->orderBy('nama_lengkap', 'asc')->paginate(10)->withQueryString();

        return view('students.index', compact('students'));
    }

    public function create(): View
    {
        $usersWithoutStudent = User::where('role', 'siswa')
            ->whereDoesntHave('student')
            ->get();

        return view('students.create', compact('usersWithoutStudent'));
    }

    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $student = Student::create($validated);

        return redirect()->route('students.show', $student)
            ->with('status', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Student $student): View
    {
        $student->load(['user', 'submissions.administrationType']);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student): View
    {
        $usersWithoutStudent = User::where('role', 'siswa')
            ->where(function ($query) use ($student) {
                $query->whereDoesntHave('student')
                    ->orWhere('id', $student->user_id);
            })
            ->get();

        return view('students.edit', compact('student', 'usersWithoutStudent'));
    }

    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {
        $validated = $request->validated();

        $student->update($validated);

        return redirect()->route('students.show', $student)
            ->with('status', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Student $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('status', 'Data siswa berhasil dihapus.');
    }
}
