<?php

namespace App\Http\Controllers\ahli\hama;

use App\Http\Controllers\Controller;
use App\Models\KriteriaHama;
use App\Models\PerbandinganSubKriteriaHama;
use App\Models\SubKriteriaHama;
use Illuminate\Http\Request;

class SubKriteriaHamaController extends Controller
{

    public function index($id)
    {
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->orderBy('created_at', 'asc')->get();
        $kriteria = KriteriaHama::findOrFail($id);
        return view('ahli.hama.sub_kriteria.sub_kriteria', compact('subKriteria', 'kriteria'));
    }

    public function post(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id'        => 'required',
                'nama'              => 'required',

            ]);
            SubKriteriaHama::create($validated);
            return redirect()->back()->with('success', 'subKriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan subKriteria. Silakan coba lagi.');
        }
    }

    public function put(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama'                => 'required',
            ]);

            $subKriteria = SubKriteriaHama::findOrFail($id);

            $subKriteria->update($validated);

            return redirect()->back()->with('success', 'SubKriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui SubKriteria. Silakan coba lagi.');
        }
    }

    public function delete($id)
    {
        $subKriteria = SubKriteriaHama::findOrFail($id);
        $subKriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }









    public function matriks($id)
    {
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->get();
        $matriks = [];

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                if ($row->id == $col->id) {
                    $matriks[$row->id][$col->id] = 1;
                } else {
                    $nilai = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $row->id)
                        ->where('sub_kriteria_id_2', $col->id)->value('nilai');

                    $nilaiKebalikan = PerbandinganSubKriteriaHama::where('sub_kriteria_id_1', $col->id)
                        ->where('sub_kriteria_id_2', $row->id)->value('nilai');

                    if ($nilai) {
                        $matriks[$row->id][$col->id] = $nilai;
                    } elseif ($nilaiKebalikan) {
                        $matriks[$row->id][$col->id] = 1 / $nilaiKebalikan;
                    } else {
                        $matriks[$row->id][$col->id] = null;
                    }
                }
            }
        }


        $subkriterias = $subKriteria->values();
        $hasil = $this->hitungBobotInternal($subkriterias);
        $konsistensi = $this->hitungKonsistensi($hasil['matriks'], $hasil['bobot']);

        foreach ($hasil['bobot'] as $idSub => $nilaiBobot) {
            SubKriteriaHama::where('id', $idSub)->update(['bobot' => $nilaiBobot]);
        }

        return view('ahli.hama.sub_kriteria.matrik_sub_kriteria', compact(
            'subKriteria',
            'matriks',
            'hasil',
            'konsistensi',
            'id'
        ));
    }



    public function postMatriks(Request $request, $id)
    {
        $matriks = $request->input('matriks', []);
        $subKriteria = SubKriteriaHama::where('kriteria_id', $id)->get();

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                $id1 = $row->id;
                $id2 = $col->id;

                if ($id1 == $id2) {
                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id1,
                        'sub_kriteria_id_2' => $id2,
                    ], ['nilai' => 1]);
                } elseif (isset($matriks[$id1][$id2])) {
                    $nilai = $matriks[$id1][$id2];

                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id1,
                        'sub_kriteria_id_2' => $id2,
                    ], ['nilai' => $nilai]);

                    PerbandinganSubKriteriaHama::updateOrCreate([
                        'sub_kriteria_id_1' => $id2,
                        'sub_kriteria_id_2' => $id1,
                    ], ['nilai' => 1 / $nilai]);
                }
            }
        }

        return redirect()->route('matriks', $id)->with('success', 'Matriks sub kriteria berhasil disimpan!');
    }




    private function hitungBobotInternal($subkriterias)
    {
        $n = count($subkriterias);
        $matriks = [];
        $totalKolom = [];
        $ids = $subkriterias->pluck('id')->toArray();


        foreach ($ids as $j) {
            $totalKolom[$j] = 0;
            foreach ($ids as $i) {
                $nilai = SubKriteriaHama::find($i)->getNilai(SubKriteriaHama::find($j));
                $matriks[$i][$j] = $nilai;
                $totalKolom[$j] += $nilai;
            }
        }


        $normalisasi = [];
        $jumlah = [];
        $bobot = [];

        foreach ($ids as $i) {
            $sum = 0;
            foreach ($ids as $j) {
                $norm = $matriks[$i][$j] / $totalKolom[$j];
                $normalisasi[$i][$j] = $norm;
                $sum += $norm;
            }
            $jumlah[$i] = $sum;
            $bobot[$i] = $sum / $n;
        }

        return compact('matriks', 'normalisasi', 'jumlah', 'bobot');
    }




    private function hitungKonsistensi($matriks, $bobot)
    {
        $n = count($bobot);
        $lambda_max = 0;

        foreach ($matriks as $i => $row) {
            $jumlah = 0;
            foreach ($row as $j => $nilai) {
                $jumlah += $nilai * $bobot[$j];
            }
            $lambda_max += $jumlah / $bobot[$i];
        }

        $lambda_max = $lambda_max / $n;
        $ci = ($lambda_max - $n) / ($n - 1);
        $ri = $this->getRI($n);
        $cr = $ri == 0 ? 0 : $ci / $ri;

        return [
            'lambda_max' => $lambda_max,
            'ci' => $ci,
            'cr' => $cr,
        ];
    }


    private function getRI($n)
    {
        $riTable = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45];
        return $riTable[$n] ?? 1.5;
    }
}
