<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $table = 'sub_kriteria';
    protected $fillable = ['kriteria_id', 'kode', 'nama', 'bobot'];


    public function getNilai(SubKriteriHama $subKriteria)
    {
        $nilai = PerbandinganSubKriteria::getNilai($this->id, $subKriteria->id);
        if ($nilai == 0) {
            $nilai = 1 / PerbandinganSubKriteria::getNilai($subKriteria->id, $this->id);
        }
        return $nilai;
    }

    public function kriteria()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }
    public function perbandinganSubKriteria1()
    {
        return $this->hasMany(PerbandinganSubKriteria::class, 'sub_kriteria_id_1');
    }
    public function perbandinganSubKriteria2()
    {
        return $this->hasMany(PerbandinganSubKriteria::class, 'sub_kriteria_id_2');
    }
    public function penilaianAlternatif()
    {
        return $this->hasMany(PenilaianAlternatif::class, 'sub_kriteria_id');
    }
}
