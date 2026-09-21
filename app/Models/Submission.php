<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pengajuan',
        'user_id',
        'student_id',
        'administration_type_id',
        'tanggal_pengajuan',
        'keperluan',
        'berkas_pendukung',
        'status',
        'catatan_petugas',
        'tanggal_selesai',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengajuan' => 'date',
            'tanggal_selesai' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function administrationType(): BelongsTo
    {
        return $this->belongsTo(AdministrationType::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(SubmissionLog::class)->orderBy('created_at', 'desc');
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (empty($term)) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('nomor_pengajuan', 'like', "%{$term}%")
                ->orWhere('keperluan', 'like', "%{$term}%")
                ->orWhereHas('student', function (Builder $sq) use ($term) {
                    $sq->where('nama_lengkap', 'like', "%{$term}%")
                        ->orWhere('nis', 'like', "%{$term}%");
                });
        });
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['administration_type_id'])) {
            $query->where('administration_type_id', $filters['administration_type_id']);
        }

        return $query;
    }
}
