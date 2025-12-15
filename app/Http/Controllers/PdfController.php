<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function exportHistoryPdf()
    {
        // Ambil semua data history hasil perhitungan
        $histories = Hasil::with(['user', 'alternatif'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Group by user untuk statistik
        $groupedByUser = $histories->groupBy('user_id');

        // Hitung motor terpopuler (yang paling banyak dipilih)
        $motorTerpopuler = $histories
            ->groupBy('alternatif_id')
            ->sortByDesc(fn($group) => $group->count())
            ->first();

        // Statistik
        $statistics = [
            'total_perhitungan' => $histories->count(),
            'total_user' => $histories->unique('user_id')->count(),
            'motor_terpopuler' => $motorTerpopuler?->first()?->alternatif->nama ?? '-',
            'hari_ini' => $histories->where('created_at', '>=', today())->count(),
        ];

        // Load view untuk PDF
        $pdf = Pdf::loadView('pdf.history-report', [
            'histories' => $histories,
            'groupedByUser' => $groupedByUser,
            'statistics' => $statistics,
            'tanggal_cetak' => now()->format('d M Y H:i'),
        ]);

        // Set paper size dan orientation
        $pdf->setPaper('a4', 'landscape');

        // Download PDF
        return $pdf->download('Laporan-Riwayat-Analisis-' . now()->format('d-m-Y') . '.pdf');
    }

    public function exportHistoryPdfByUser($userId)
    {
        // Ambil data history per user
        $histories = Hasil::with(['user', 'alternatif'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($histories->isEmpty()) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $user = $histories->first()->user;

        // Statistik user
        $statistics = [
            'total_analisis' => $histories->count(),
            'motor_favorit' => $histories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first() ? $histories->firstWhere('alternatif_id', $histories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first())->alternatif->nama : '-',
            'skor_tertinggi' => number_format($histories->max('skor'), 3),
            'terakhir_analisis' => $histories->sortByDesc('created_at')->first()->created_at->diffForHumans(),
        ];

        // Load view untuk PDF
        $pdf = Pdf::loadView('pdf.history-user-report', [
            'user' => $user,
            'histories' => $histories,
            'statistics' => $statistics,
            'tanggal_cetak' => now()->format('d M Y H:i'),
        ]);

        // Set paper size
        $pdf->setPaper('a4', 'portrait');

        // Download PDF
        return $pdf->download('Laporan-Analisis-' . $user->name . '-' . now()->format('d-m-Y') . '.pdf');
    }

    public function exportMyHistoryPdf()
    {
        // Ambil data history user yang sedang login
        $userId = auth()->id();
        $histories = Hasil::with(['user', 'alternatif'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($histories->isEmpty()) {
            return redirect()->back()->with('error', 'Anda belum memiliki riwayat analisis');
        }

        $user = auth()->user();

        // Statistik user
        $statistics = [
            'total_analisis' => $histories->count(),
            'motor_favorit' => $histories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first() ? $histories->firstWhere('alternatif_id', $histories->groupBy('alternatif_id')->sortByDesc(fn($group) => $group->count())->keys()->first())->alternatif->nama : '-',
            'skor_tertinggi' => number_format($histories->max('skor'), 3),
            'terakhir_analisis' => $histories->sortByDesc('created_at')->first()->created_at->diffForHumans(),
        ];

        // Load view untuk PDF
        $pdf = Pdf::loadView('pdf.history-user-report', [
            'user' => $user,
            'histories' => $histories,
            'statistics' => $statistics,
            'tanggal_cetak' => now()->format('d M Y H:i'),
        ]);

        // Set paper size
        $pdf->setPaper('a4', 'portrait');

        // Download PDF
        return $pdf->download('Riwayat-Analisis-Saya-' . now()->format('d-m-Y') . '.pdf');
    }

    public function exportHasilPdf($id)
    {
        // Ambil data hasil berdasarkan ID
        $hasil = Hasil::with(['user', 'alternatif'])->findOrFail($id);

        // Pastikan user hanya bisa export hasil miliknya sendiri
        if ($hasil->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk export data ini');
        }

        // Ambil sub kriteria yang dipilih
        $subKriteriaIds = json_decode($hasil->sub_kriteria_ids, true);
        $subKriterias = \App\Models\SubKriteria::with('kriteria')
            ->whereIn('id', $subKriteriaIds)
            ->get();

        // Load view untuk PDF
        $pdf = Pdf::loadView('pdf.hasil-report', [
            'hasil' => $hasil,
            'subKriterias' => $subKriterias,
            'tanggal_cetak' => now()->format('d M Y H:i'),
        ]);

        // Set paper size
        $pdf->setPaper('a4', 'portrait');

        // Bersihkan nama file dari karakter yang tidak diperbolehkan
        $motorNama = preg_replace('/[\/\\\\:*?"<>|]/', '-', $hasil->alternatif->nama);
        $motorNama = preg_replace('/\s+/', '-', $motorNama); // Replace spaces dengan dash

        // Download PDF
        return $pdf->download('Hasil-Rekomendasi-' . $motorNama . '-' . now()->format('d-m-Y') . '.pdf');
    }
}
