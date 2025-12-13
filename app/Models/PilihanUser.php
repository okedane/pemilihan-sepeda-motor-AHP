<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PilihanUser extends Model
{
    use HasFactory;
    protected $table = 'pilihan_user';
    protected $fillable = ['user_id', 'sub_kriteria_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subkriteria()
    {
        return $this->belongsTo(SubKriteria::class, 'sub_kriteria_id');
    }
}
