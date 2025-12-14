<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenilaianAlternatifHama extends Model
{
    use HasFactory;

    protected $table = 'penilaian_alternatif_hamas';

    protected $fillable = [
        'alternatif_id',
        'sub_kriteria_id',
        'nilai',
    ];

    // Relasi ke alternatif hama
    public function alternatif()
    {
        return $this->belongsTo(AlternatifHama::class, 'alternatif_id');
    }

    // Relasi ke sub kriteria hama
    public function subKriteria()
    {
        return $this->belongsTo(SubKriteriaHama::class, 'sub_kriteria_id');
    }
}
