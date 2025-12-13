<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/GejalaPetani.php

class GejalaPetani extends Model
{
    use HasFactory;

    // Tambahkan baris ini:
    protected $table = 'gejala_petani';

    protected $fillable = ['user_id', 'sub_kriteria_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subkriteria()
    {
        return $this->belongsTo(SubKriteriaHama::class, 'sub_kriteria_id');
    }
}
