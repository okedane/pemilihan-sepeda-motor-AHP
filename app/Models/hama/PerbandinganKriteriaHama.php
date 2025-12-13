<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PerbandinganKriteriaHama extends Model
{
    use HasFactory;

    protected $table = 'perbandingan_kriteria_hamas';

    protected $fillable = ['kriteria_id_1', 'kriteria_id_2', 'nilai'];

    public static function getNilai($id1, $id2)
    {
        return self::where('kriteria_id_1', $id1)
            ->where('kriteria_id_2', $id2)
            ->value('nilai') ?? 0;
    }

    public function kriteria1()
    {
        return $this->belongsTo(KriteriaHama::class, 'kriteria_id_1');
    }

    public function kriteria2()
    {
        return $this->belongsTo(KriteriaHama::class, 'kriteria_id_2');
    }
}
