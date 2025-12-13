<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    use HasFactory;
    protected $table = 'kriteria';
    protected $fillable = ['kode', 'nama'];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }

    public function perbandinganKriteria1()
    {
        return $this->hasMany(PerbandinganKriteria::class, 'kriteria_id_1');
    }

    public function perbandinganKriteria2()
    {
        return $this->hasMany(PerbandinganKriteria::class, 'kriteria_id_2');
    }
}
