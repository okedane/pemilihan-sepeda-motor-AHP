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
}
