<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdministrationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'kode_layanan',
        'deskripsi',
        'persyaratan',
        'estimasi_hari',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'estimasi_hari' => 'integer',
        ];
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
