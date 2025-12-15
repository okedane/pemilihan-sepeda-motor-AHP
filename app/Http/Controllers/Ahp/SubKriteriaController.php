<?php

namespace App\Http\Controllers\Ahp;

use App\Http\Controllers\Controller;
use App\Models\kriteria;
use App\Models\PerbandinganSubKriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index($id)
    {
        $subKriteria = SubKriteria::where('kriteria_id', $id)->orderBy('created_at', 'asc')->get();
        $kriteria = kriteria::findOrFail($id);
        return view('ahp.subkriteria.sub_kriteria', compact('subKriteria', 'kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kriteria_id' => 'required',
                'nama' => 'required',
            ]);

            // Hitung jumlah subkriteria dengan kriteria_id yang sama
            $count = SubKriteria::where('kriteria_id', $validated['kriteria_id'])->count() + 1;
            $validated['kode'] = 'S' . $count;

            SubKriteria::create($validated);
            return redirect()->back()->with('success', 'subKriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan subKriteria. Silakan coba lagi.'. $th->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $subKriteria = SubKriteria::findOrFail($id);

            $subKriteria->update($validated);

            return redirect()->back()->with('success', 'SubKriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui SubKriteria. Silakan coba lagi.');
        }
    }

    public function delete(SubKriteria $id)
    {
        try {
            $deletedNumber = (int) str_replace('S', '', $id->kode);

            // Hapus data
            $id->delete();

            // Ambil semua data setelah kode yang dihapus
            $updateKode = SubKriteria::where('kriteria_id', $id->kriteria_id)
            ->whereRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) > ?', [$deletedNumber])
            ->orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED)')
            ->get();

            // Update ulang kode-kode setelahnya
            foreach ($updateKode as $item) {
            $currentNumber = (int) str_replace('S', '', $item->kode);
            $newNumber = $currentNumber - 1;
            $item->update(['kode' => 'S' . $newNumber]);
            }

            return redirect()->back()->with('success', 'SubKriteria berhasil dihapus.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus SubKriteria. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function matriks($id)
    {
        $subKriteria = SubKriteria::where('kriteria_id', $id)->get();
        $matriks = [];
        $lengkap = true;

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                if ($row->id == $col->id) {
                    $matriks[$row->id][$col->id] = 1;
                } else {
                    $nilai = PerbandinganSubKriteria::where('sub_kriteria_id_1', $row->id)->where('sub_kriteria_id_2', $col->id)->value('nilai');

                    $nilaiKebalikan = PerbandinganSubKriteria::where('sub_kriteria_id_1', $col->id)->where('sub_kriteria_id_2', $row->id)->value('nilai');

                    if ($nilai) {
                        $matriks[$row->id][$col->id] = $nilai;
                    } elseif ($nilaiKebalikan) {
                        $matriks[$row->id][$col->id] = 1 / $nilaiKebalikan;
                    } else {
                        $matriks[$row->id][$col->id] = null;
                        $lengkap = false;
                    }
                }
            }
        }

        $subkriterias = $subKriteria->values();
        $hasil = $this->hitungBobotInternal($subkriterias);
        $konsistensi = $this->hitungKonsistensi($hasil['matriks'], $hasil['bobot']);

        if ($lengkap) {
            foreach ($hasil['bobot'] as $idSub => $nilaiBobot) {
                SubKriteria::where('id', $idSub)->update(['bobot' => $nilaiBobot]);
            }
        }

        return view('ahp.subkriteria.matrix_subKriteria', compact('subKriteria', 'matriks', 'hasil', 'konsistensi', 'id', 'lengkap'));
    }

    public function postMatriks(Request $request, $id)
    {
        $matriks = $request->input('matriks', []);
        $subKriteria = SubKriteria::where('kriteria_id', $id)->get();

        foreach ($subKriteria as $row) {
            foreach ($subKriteria as $col) {
                $id1 = $row->id;
                $id2 = $col->id;

                if ($id1 == $id2) {
                    PerbandinganSubKriteria::updateOrCreate(
                        [
                            'sub_kriteria_id_1' => $id1,
                            'sub_kriteria_id_2' => $id2,
                        ],
                        ['nilai' => 1],
                    );
                } elseif (isset($matriks[$id1][$id2])) {
                    $nilai = $matriks[$id1][$id2];

                    PerbandinganSubKriteria::updateOrCreate(
                        [
                            'sub_kriteria_id_1' => $id1,
                            'sub_kriteria_id_2' => $id2,
                        ],
                        ['nilai' => $nilai],
                    );

                    PerbandinganSubKriteria::updateOrCreate(
                        [
                            'sub_kriteria_id_1' => $id2,
                            'sub_kriteria_id_2' => $id1,
                        ],
                        ['nilai' => 1 / $nilai],
                    );
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
                $nilai = SubKriteria::find($i)->getNilai(SubKriteria::find($j));
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
