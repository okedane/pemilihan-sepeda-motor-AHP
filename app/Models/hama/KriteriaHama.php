<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KriteriaHama extends Model
{
    use HasFactory;

    protected $table = 'kriteria_hama';

    protected $fillable = ['kode', 'nama'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteriaHama::class, 'kriteria_id');
    }

    public function perbandinganKriteria1()
    {
        return $this->hasMany(PerbandinganKriteriaHama::class, 'kriteria_id_1');
    }

    public function perbandinganKriteria2()
    {
        return $this->hasMany(PerbandinganKriteriaHama::class, 'kriteria_id_2');
    }
}
