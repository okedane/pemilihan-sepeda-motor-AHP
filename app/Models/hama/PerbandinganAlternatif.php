<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganAlternatif extends Model
{
    use HasFactory;
    protected $table = 'perbandingan_alternatif';
    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai',
    ];

    // Relasi ke Alternatif
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
    // Relasi ke Kriteria
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}
