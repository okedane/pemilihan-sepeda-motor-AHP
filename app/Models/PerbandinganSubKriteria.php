<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganSubKriteria extends Model
{
    use HasFactory;
    protected $table = 'perbandingan_sub_kriterias';
    protected $fillable = ['sub_kriteria_id_1', 'sub_kriteria_id_2', 'nilai'];
    public static function getNilai($id1, $id2)
    {
        return self::where('sub_kriteria_id_1', $id1)
            ->where('sub_kriteria_id_2', $id2)
            ->value('nilai') ?? 0;
    }
    public function subKriteria1()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id_1');
    }
    public function subKriteria2()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id_2');
    }
}
