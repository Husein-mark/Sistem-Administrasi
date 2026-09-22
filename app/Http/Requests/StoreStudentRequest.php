<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'exists:users,id', Rule::unique('students', 'user_id')],
            'nis' => ['required', 'string', 'max:20', 'unique:students,nis'],
            'nisn' => ['required', 'string', 'max:20', 'unique:students,nisn'],
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
