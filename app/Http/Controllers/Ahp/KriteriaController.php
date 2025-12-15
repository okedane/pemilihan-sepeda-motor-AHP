<?php

namespace App\Http\Controllers\Ahp;

use App\Http\Controllers\Controller;
use App\Models\kriteria;
use App\Models\PerbandinganKriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = kriteria::orderBy('created_at', 'asc')->get();
        return view('ahp.kriteria.kriteria', compact('kriteria'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $lastNumber = Kriteria::count() + 1;
            $validated['kode'] = 'C' . $lastNumber;

            kriteria::create($validated);
            return redirect()->back()->with('success', 'Kriteria berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Kriteria. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'nama' => 'required',
            ]);

            $kriteria = kriteria::findOrFail($id);
            $kriteria->update($validated);

            return redirect()->back()->with('success', 'Kriteria berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui Kriteria. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete(Kriteria $id)
    {
        try {
            $deletedNumber = (int) str_replace('C', '', $id->kode);

            // Hapus data
            $id->delete();

            // Ambil semua data setelah kode yang dihapus
            $updateKode = Kriteria::whereRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED) > ?', [$deletedNumber])
                                             ->orderByRaw('CAST(SUBSTRING(kode, 2) AS UNSIGNED)')
                                             ->get();

            // Update ulang kode-kode setelahnya
            foreach ($updateKode as $item) {
                $currentNumber = (int) str_replace('C', '', $item->kode);
                $newNumber = $currentNumber - 1;
                $item->update(['kode' => 'C' . $newNumber]);
            }

            return redirect()->back()->with('success', 'Kriteria berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus Kriteria. Silakan coba lagi.');
        }
    }

    public function matriks()
    {
        $kriterias = Kriteria::all();

        $matriks = [];
        $editable = [];
        $lengkap = true; // ⬅️ FLAG

        foreach ($kriterias as $row) {
            foreach ($kriterias as $col) {
                if ($row->id === $col->id) {
                    $matriks[$row->id][$col->id] = 1;
                    $editable[$row->id][$col->id] = false;
                } else {
                    $nilai = PerbandinganKriteria::where('kriteria_id_1', $row->id)->where('kriteria_id_2', $col->id)->value('nilai');

                    if ($nilai) {
                        $matriks[$row->id][$col->id] = $nilai;
                        $editable[$row->id][$col->id] = true;
                    } else {
                        $nilai_kebalikan = PerbandinganKriteria::where('kriteria_id_1', $col->id)->where('kriteria_id_2', $row->id)->value('nilai');

                        if ($nilai_kebalikan) {
                            $matriks[$row->id][$col->id] = round(1 / $nilai_kebalikan, 4);
                            $editable[$row->id][$col->id] = false;
                        } else {
                            $matriks[$row->id][$col->id] = null;
                            $editable[$row->id][$col->id] = true;
                            $lengkap = false; // ⛔ matriks belum lengkap
                        }
                    }
                }
            }
        }

        $hasil = null;
        $konsistensi = null;

        // ⬅️ HITUNG HANYA JIKA LENGKAP
        if ($lengkap && $kriterias->count() > 1) {
            $hasil = $this->hitungBobotInternal($kriterias, $matriks);
            $this->simpanBobotKriteria($hasil['rataRata']);
            $konsistensi = $this->hitungKonsistensi();
        }

        return view('ahp.kriteria.matrix_kriteria', compact('kriterias', 'matriks', 'editable', 'hasil', 'konsistensi', 'lengkap'));
    }

    public function storeMatriks(Request $request)
    {
        $matriks = $request->input('matriks', []);
        $kriterias = Kriteria::all();

        foreach ($kriterias as $row) {
            foreach ($kriterias as $col) {
                $id1 = $row->id;
                $id2 = $col->id;

                if ($id1 == $id2) {
                    PerbandinganKriteria::updateOrCreate(
                        [
                            'kriteria_id_1' => $id1,
                            'kriteria_id_2' => $id2,
                        ],
                        [
                            'nilai' => 1,
                        ],
                    );
                } elseif (isset($matriks[$id1][$id2])) {
                    $nilai = $matriks[$id1][$id2];

                    PerbandinganKriteria::updateOrCreate(
                        [
                            'kriteria_id_1' => $id1,
                            'kriteria_id_2' => $id2,
                        ],
                        [
                            'nilai' => $nilai,
                        ],
                    );

                    PerbandinganKriteria::updateOrCreate(
                        [
                            'kriteria_id_1' => $id2,
                            'kriteria_id_2' => $id1,
                        ],
                        [
                            'nilai' => round(1 / $nilai, 4),
                        ],
                    );
                }
            }
        }

        // 🔁 Tambahkan proses perhitungan bobot dan simpan
        $matriksBaru = [];

        foreach ($kriterias as $row) {
            foreach ($kriterias as $col) {
                if ($row->id === $col->id) {
                    $matriksBaru[$row->id][$col->id] = 1;
                } else {
                    $nilai = PerbandinganKriteria::where('kriteria_id_1', $row->id)->where('kriteria_id_2', $col->id)->value('nilai');

                    if (!$nilai) {
                        $nilaiKebalikan = PerbandinganKriteria::where('kriteria_id_1', $col->id)->where('kriteria_id_2', $row->id)->value('nilai');

                        $nilai = $nilaiKebalikan ? round(1 / $nilaiKebalikan, 4) : 0;
                    }

                    $matriksBaru[$row->id][$col->id] = $nilai;
                }
            }
        }

        // Hitung bobot lalu simpan
        $hasil = $this->hitungBobotInternal($kriterias, $matriksBaru);
        $this->simpanBobotKriteria($hasil['rataRata']);

        return redirect()->route('kriteria.matriks')->with('success', 'Matriks dan bobot berhasil disimpan!');
    }
    private function hitungBobotInternal($kriterias, $matriks)
    {
        $jumlahKolom = [];
        foreach ($kriterias as $col) {
            $total = 0;
            foreach ($kriterias as $row) {
                $total += $matriks[$row->id][$col->id] ?? 0;
            }
            $jumlahKolom[$col->id] = $total;
        }

        $matriksNormalisasi = [];
        $rataRata = [];

        foreach ($kriterias as $row) {
            $totalBaris = 0;
            foreach ($kriterias as $col) {
                $nilai = $matriks[$row->id][$col->id] ?? 0;
                $normal = $jumlahKolom[$col->id] != 0 ? round($nilai / $jumlahKolom[$col->id], 4) : 0;

                $matriksNormalisasi[$row->id][$col->id] = $normal;
                $totalBaris += $normal;
            }

            $rataRata[$row->id] = round($totalBaris / count($kriterias), 4);
        }

        return [
            'normalisasi' => $matriksNormalisasi,
            'rataRata' => $rataRata,
        ];
    }

    private function simpanBobotKriteria($rataRata)
    {
        foreach ($rataRata as $kriteriaId => $bobot) {
            kriteria::where('id', $kriteriaId)->update([
                'bobot' => $bobot,
            ]);
        }
    }

    public function hitungKonsistensi()
    {
        $kriterias = Kriteria::all();
        $n = $kriterias->count();

        // Hitung jumlah kolom untuk normalisasi
        $jumlahKolom = [];

        foreach ($kriterias as $col) {
            $jumlah = 0;
            foreach ($kriterias as $row) {
                $jumlah += PerbandinganKriteria::getNilai($row->id, $col->id); // ✅ gunakan model langsung
            }
            $jumlahKolom[$col->id] = $jumlah;
        }

        // Hitung bobot dari matriks normalisasi
        $normalisasi = [];
        $bobot = [];

        foreach ($kriterias as $row) {
            $total = 0;
            foreach ($kriterias as $col) {
                $nilai = PerbandinganKriteria::getNilai($row->id, $col->id); // ✅ gunakan model langsung
                $normal = $jumlahKolom[$col->id] != 0 ? $nilai / $jumlahKolom[$col->id] : 0;

                $normalisasi[$row->id][$col->id] = $normal;
                $total += $normal;
            }

            $bobot[$row->id] = $total / $n;
        }

        // Hitung lambda max
        $lambdaMax = 0;
        foreach ($kriterias as $row) {
            $total = 0;
            foreach ($kriterias as $col) {
                $nilai = PerbandinganKriteria::getNilai($row->id, $col->id);
                $total += $nilai * $bobot[$col->id]; // A * w
            }

            if ($bobot[$row->id] == 0) {
                continue;
            } // cegah pembagian nol

            $lambdaMax += $total / $bobot[$row->id]; // (Aw)/w
        }
        $lambdaMax = $lambdaMax / $n; // rata-rata lambdaMax

        // Hitung Consistency Index (CI)
        $ci = ($lambdaMax - $n) / ($n - 1);

        // Hitung Consistency Ratio (CR)
        $ri = $this->getRI($n);
        $cr = $ri == 0 ? 0 : $ci / $ri;

        return [
            'lambda_max' => round($lambdaMax, 4),
            'ci' => round($ci, 4),
            'cr' => round($cr, 4),
            'bobot' => $bobot,
        ];
    }

    private function getRI($n)
    {
        $riTable = [
            1 => 0.0,
            2 => 0.0,
            3 => 0.58,
            4 => 0.9,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49,
        ];

        return $riTable[$n] ?? 1.49;
    }
}
