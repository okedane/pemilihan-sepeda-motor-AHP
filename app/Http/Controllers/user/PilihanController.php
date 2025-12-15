<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\Hasil;
use App\Models\kriteria;
use App\Models\PerbandinganAlternatif;
use App\Models\PilihanUser;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PilihanController extends Controller
{
     public function inputData()
    {
        $kriterias = kriteria::with('subKriterias')->get();
        return view('user.inputData', compact('kriterias'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'sub_kriteria' => 'required|array',
        ]);

        $userId = Auth::id();


        PilihanUser::where('user_id', $userId)->delete();


        foreach ($request->sub_kriteria as $kriteriaId => $subKriteriaId) {
            PilihanUser::create([
                'user_id' => $userId,
                'sub_kriteria_id' => $subKriteriaId,
            ]);
        }


        return $this->pilih($request);
    }



    public function pilih(Request $request)
    {
        $userId = Auth::id();


        $subKriteriaIds = PilihanUser::where('user_id', $userId)->pluck('sub_kriteria_id')->toArray();

        if (empty($subKriteriaIds)) {
            return redirect()->route('user.inputData')->with('error', 'Silakan isi gejala terlebih dahulu.');
        }

        $alternatifs = Alternatif::all();
        $subkriterias = SubKriteria::with('kriteria')->get();


        $bobotSub = [];
        $bobotKriteria = [];

        foreach ($subkriterias as $sub) {
            $bobotSub[$sub->id] = $sub->bobot;
            $bobotKriteria[$sub->id] = $sub->kriteria->bobot;
        }


        $hasil = [];

        foreach ($alternatifs as $alt) {
            $skor = 0;
            $detail = [];

            foreach ($subKriteriaIds as $subId) {
                $data = PerbandinganAlternatif::where('alternatif_id', $alt->id)
                    ->where('sub_kriteria_id', $subId)
                    ->first();

                $nilai = $data->nilai ?? 0;
                $normalisasi = $data->normalisasi ?? 0;

                $bobot_sub = $bobotSub[$subId] ?? 0;
                $bobot_kriteria = $bobotKriteria[$subId] ?? 0;

                $skorPartial = $normalisasi * $bobot_sub * $bobot_kriteria;
                $skor += $skorPartial;

                $detail[] = [
                    'sub_id' => $subId,
                    'nilai' => $nilai,
                    'normalisasi' => $normalisasi,
                    'bobot_sub' => $bobot_sub,
                    'bobot_kriteria' => $bobot_kriteria,
                    'skor_partial' => $skorPartial,
                ];
            }

            $hasil[] = [
                'alternatif_id' => $alt->id,
                'nama' => $alt->nama,
                'skor' => round($skor, 5),
                'detail' => $detail,
            ];
        }


        usort($hasil, fn($a, $b) => $b['skor'] <=> $a['skor']);
        $terbaik = $hasil[0];


        $hasilRecord = Hasil::create([
            'user_id' => $userId,
            'sub_kriteria_ids' => json_encode($subKriteriaIds),
            'alternatif_id' => $terbaik['alternatif_id'],
            'skor' => $terbaik['skor'],
            'tanggal' => now(),
        ]);

        $analisis_id = $hasilRecord->id;

        return view('user.hasil', compact('hasil', 'terbaik', 'analisis_id'));
    }
}
