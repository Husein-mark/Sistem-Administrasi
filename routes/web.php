<?php

use App\Http\Controllers\AdministrationTypeController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/cari-siswa', [PublicController::class, 'searchStudents'])->name('public.students');
Route::get('/siswa/{student}', [PublicController::class, 'showStudent'])->name('public.students.show');
Route::get('/lacak-pengajuan', [PublicController::class, 'trackSubmission'])->name('public.tracking');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
    Route::get('/submissions/create', [SubmissionController::class, 'create'])->name('submissions.create')->middleware('role:siswa,admin');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store')->middleware('role:siswa,admin');
    Route::get('/submissions/{submission}', [SubmissionController::class, 'show'])->name('submissions.show');
    Route::delete('/submissions/{submission}', [SubmissionController::class, 'destroy'])->name('submissions.destroy');

    Route::middleware('role:kepala_sekolah,admin')->prefix('approvals')->name('approvals.')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('index');
        Route::get('/{submission}', [ApprovalController::class, 'show'])->name('show');
        Route::put('/{submission}', [ApprovalController::class, 'update'])->name('update');
    });

    Route::middleware('role:admin')->group(function () {
        Route::resource('students', StudentController::class);
        Route::resource('administration-types', AdministrationTypeController::class)->except(['show']);
    });
});
