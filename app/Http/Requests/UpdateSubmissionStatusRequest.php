<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubmissionStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'in:menunggu,diproses,disetujui,ditolak'],
            'catatan_petugas' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
