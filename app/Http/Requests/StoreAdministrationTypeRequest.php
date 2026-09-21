<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdministrationTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_layanan' => ['required', 'string', 'max:255'],
            'kode_layanan' => ['required', 'string', 'max:20', 'unique:administration_types,kode_layanan'],
            'deskripsi' => ['nullable', 'string'],
            'persyaratan' => ['nullable', 'string'],
            'estimasi_hari' => ['required', 'integer', 'min:1', 'max:60'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
