<?php

namespace App\Http\Controllers;

use App\Models\Hasil;

class HasilPerhitunganController extends Controller
{
    public function index()
    {
        // Ambil semua data history hasil perhitungan dengan relasi user dan alternatif
        $histories = Hasil::with(['user', 'alternatif'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('hasil.index', compact('histories'));
    }
}
