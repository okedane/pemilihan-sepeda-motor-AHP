<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlternatifHama extends Model
{
    use HasFactory;
    protected $table = 'alternatif_hamas';
    protected $fillable = ['kode', 'nama'];

    public function penilaian()
    {
        return $this->hasMany(PenilaianAlternatifHama::class, 'alternatif_id');
    }
    public function hasilDiagnosa()
    {
        return $this->hasMany(HasilDiagnosaPetani::class, 'alternatif_id');
    }

}
