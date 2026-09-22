<?php

namespace App\Http\Requests;

use App\Models\Student;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student') instanceof Student
            ? $this->route('student')->id
            : $this->route('student');

        return [
            'user_id' => ['nullable', 'exists:users,id', Rule::unique('students', 'user_id')->ignore($studentId)],
            'nis' => ['required', 'string', 'max:20', Rule::unique('students', 'nis')->ignore($studentId)],
            'nisn' => ['required', 'string', 'max:20', Rule::unique('students', 'nisn')->ignore($studentId)],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'kelas' => ['required', 'string', 'max:20'],
            'jurusan' => ['required', 'in:TKJ,RPL,DKV'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat' => ['nullable', 'string'],
            'no_telepon' => ['nullable', 'string', 'max:20'],
            'status_aktif' => ['required', 'in:aktif,lulus,mutasi,non-aktif'],
        ];
    }
}
