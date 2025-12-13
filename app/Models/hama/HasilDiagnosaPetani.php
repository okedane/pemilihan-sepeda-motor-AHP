<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilDiagnosaPetani extends Model
{
    use HasFactory;

    protected $table = 'hasil_diagnosa_petani';

    protected $fillable = [
        'user_id',
        'sub_kriteria_ids',
        'alternatif_id',
        'skor',
    ];

    protected $casts = [
        'sub_kriteria_ids' => 'array',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Alternatif Hama
    public function alternatif()
    {
        return $this->belongsTo(AlternatifHama::class, 'alternatif_id');
    }
}
