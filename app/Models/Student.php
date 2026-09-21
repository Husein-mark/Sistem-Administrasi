<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nis',
        'nisn',
        'nama_lengkap',
        'jenis_kelamin',
        'kelas',
        'jurusan',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_telepon',
        'status_aktif',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('nama_lengkap', 'like', "%{$term}%")
                ->orWhere('nis', 'like', "%{$term}%")
                ->orWhere('nisn', 'like', "%{$term}%")
                ->orWhere('kelas', 'like', "%{$term}%");
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (! empty($filters['jurusan'])) {
            $query->where('jurusan', $filters['jurusan']);
        }

        if (! empty($filters['status_aktif'])) {
            $query->where('status_aktif', $filters['status_aktif']);
        }

        if (! empty($filters['kelas'])) {
            $query->where('kelas', 'like', "%{$filters['kelas']}%");
        }

        return $query;
    }
}
