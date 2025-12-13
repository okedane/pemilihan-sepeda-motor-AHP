<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatifs';
    protected $fillable = ['kode', 'nama'];
    public function penilaian()
    {
        return $this->hasMany(PerbandinganAlternatif::class, 'alternatif_id');
    }
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'alternatif_id');
    }
}
