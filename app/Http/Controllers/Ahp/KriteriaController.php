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
                'kode' => 'required',
                'nama' => 'required',
            ]);

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
                'kode' => 'required',
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

    public function delete($id)
    {
        $kriteria = kriteria::findOrFail($id);
        $kriteria->delete();

        return back()->with('success', 'data telah dihapus');
    }

    public function matriks()
    {
        $kriterias = Kriteria::all();

        // Matriks utama dan pengontrol kolom editable
        $matriks = [];
        $editable = [];

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
                            $nilai = round(1 / $nilai_kebalikan, 4);
                            $matriks[$row->id][$col->id] = $nilai;
                            $editable[$row->id][$col->id] = false;
                        } else {
                            $matriks[$row->id][$col->id] = null;
                            $editable[$row->id][$col->id] = true;
                        }
                    }
                }
            }
        }

        // Proses perhitungan bobot dan konsistensi
        $hasil = $this->hitungBobotInternal($kriterias, $matriks);
        $this->simpanBobotKriteria($hasil['rataRata']);

        // Hitung λmax, CI, dan CR untuk cek konsistensi
        $konsistensi = $this->hitungKonsistensi($matriks, $hasil['rataRata']);

        return view('kriteria.matrix_kriteria', [
            'kriterias' => $kriterias,
            'matriks' => $matriks,
            'editable' => $editable,
            'hasil' => $hasil,
            'konsistensi' => $konsistensi,
        ]);
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
}
