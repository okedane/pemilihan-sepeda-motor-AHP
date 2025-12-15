<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';
    protected $fillable = ['kode', 'nama', 'harga', 'deskripsi'];
    public function penilaian()
    {
        return $this->hasMany(PerbandinganAlternatif::class, 'alternatif_id');
    }
    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'alternatif_id');
    }
}
