<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKriteriaHama extends Model
{
    use HasFactory;

    protected $table = 'sub_kriteria_hamas';

    protected $fillable = ['kriteria_id', 'kode', 'nama', 'bobot'];

    public function getNilai(SubKriteriaHama $lainnya)
    {
        $nilai = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $this->id)
            ->where('sub_kriteria_id_2', $lainnya->id)
            ->value('nilai');

        if ($nilai) return $nilai;

        $nilaiKebalikan = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $lainnya->id)
            ->where('sub_kriteria_id_2', $this->id)
            ->value('nilai');

        return $nilaiKebalikan ? 1 / $nilaiKebalikan : 1; // Default 1 jika tidak ada data
    }


    public function kriteria()
    {
        return $this->belongsTo(KriteriaHama::class, 'kriteria_id');
    }

    public function perbandingan1()
    {
        return $this->hasMany(PerbandinganSubKriteriaHama::class, 'sub_kriteria_id_1');
    }

    public function perbandingan2()
    {
        return $this->hasMany(PerbandinganSubKriteriaHama::class, 'sub_kriteria_id_2');
    }
    public function penilaianAlternatif()
    {
        return $this->hasMany(PenilaianAlternatifHama::class, 'sub_kriteria_id');
    }
}
