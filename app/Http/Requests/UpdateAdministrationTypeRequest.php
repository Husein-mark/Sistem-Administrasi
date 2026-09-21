<?php

namespace App\Http\Requests;

use App\Models\AdministrationType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdministrationTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $typeId = $this->route('administration_type') instanceof AdministrationType
            ? $this->route('administration_type')->id
            : $this->route('administration_type');

        return [
            'nama_layanan' => ['required', 'string', 'max:255'],
            'kode_layanan' => ['required', 'string', 'max:20', Rule::unique('administration_types', 'kode_layanan')->ignore($typeId)],
            'deskripsi' => ['nullable', 'string'],
            'persyaratan' => ['nullable', 'string'],
            'estimasi_hari' => ['required', 'integer', 'min:1', 'max:60'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
