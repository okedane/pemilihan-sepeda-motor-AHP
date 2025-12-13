<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerbandinganSubKriteriaHama extends Model
{
    use HasFactory;

    protected $table = 'perbandingan_sub_kriteria_hamas';

    protected $fillable = ['sub_kriteria_id_1', 'sub_kriteria_id_2', 'nilai'];

    public function getNilai(SubKriteriaHama $lainnya)
    {
        $nilai = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $this->id)
            ->where('sub_kriteria_id_2', $lainnya->id)
            ->value('nilai');

        if ($nilai) return $nilai;

        $nilaiKebalikan = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $lainnya->id)
            ->where('sub_kriteria_id_2', $this->id)
            ->value('nilai');

        return $nilaiKebalikan ? 1 / $nilaiKebalikan : null;
    }


    public function subKriteria1()
    {
        return $this->belongsTo(SubKriteriaHama::class, 'sub_kriteria_id_1');
    }

    public function subKriteria2()
    {
        return $this->belongsTo(SubKriteriaHama::class, 'sub_kriteria_id_2');
    }
}
