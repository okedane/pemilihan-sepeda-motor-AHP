<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahunTerpilih = $request->input('tahun', date('Y'));

        // Ambil semua tahun unik dari data penilaian
        $tahunList = Hasil::selectRaw('YEAR(tanggal) as tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun')->toArray();

        // Label bulan (digunakan di chart dan view)
        $namaBulanChart = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // Inisialisasi array 12 bulan default 0
        $defaultBulan = array_fill(1, 12, 0);

        // Query jumlah penilaian per bulan
        $data = Hasil::whereYear('tanggal', $tahunTerpilih)->selectRaw('MONTH(tanggal) as bulan, COUNT(*) as jumlah')->groupBy('bulan')->pluck('jumlah', 'bulan')->toArray();

        // Gabungkan default + data query
        $jumlahRekomendasi = array_replace($defaultBulan, $data);

        return view('admin.index', compact('tahunList', 'tahunTerpilih', 'namaBulanChart', 'jumlahRekomendasi'));
    }

    public function user(Request $request)
    {
        return view('user.dashboard');
    }
}
