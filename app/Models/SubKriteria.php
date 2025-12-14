<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriteria';
    protected $fillable = ['kriteria_id', 'kode', 'nama', 'bobot'];


     public function getNilai(SubKriteria $lainnya)
    {
        $nilai = PerbandinganSubKriteria::where('sub_kriteria_id_1', $this->id)
            ->where('sub_kriteria_id_2', $lainnya->id)
            ->value('nilai');

        if ($nilai) return $nilai;

        $nilaiKebalikan = PerbandinganSubKriteria::where('sub_kriteria_id_1', $lainnya->id)
            ->where('sub_kriteria_id_2', $this->id)
            ->value('nilai');

        return $nilaiKebalikan ? 1 / $nilaiKebalikan : 1; // Default 1 jika tidak ada data
    }

    public function kriteria()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }

     public function perbandingan1()
    {
        return $this->hasMany(PerbandinganSubKriteria::class, 'sub_kriteria_id_1');
    }

    public function perbandingan2()
    {
        return $this->hasMany(PerbandinganSubKriteria::class, 'sub_kriteria_id_2');
    }
    public function penilaianAlternatif()
    {
        return $this->hasMany(PenilaianAlternatif::class, 'sub_kriteria_id');
    }
}
