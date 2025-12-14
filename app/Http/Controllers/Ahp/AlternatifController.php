<?php

namespace App\Http\Controllers\Ahp;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\kriteria;
use App\Models\PerbandinganAlternatif;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
     public function index()
    {
        $alternatif = Alternatif::orderBy('created_at', 'asc')->get();
        return view('ahp.alternatif.alternatif', compact('alternatif'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            Alternatif::create($validated);
            return redirect()->back()->with('success', 'Jabatan berhasil di tambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan Jabatan. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            $alternatif = Alternatif::findOrFail($id);
            $alternatif->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return back()->with('success', 'data telah dihapus');
    }


    public function tampilPenilaianAlternatif()
    {
        $alternatifs = Alternatif::all();
        $kriterias = kriteria::with('subkriterias')->get();

        // Ambil nilai penilaian jika sudah pernah diisi
        $penilaian = [];
        $normalisasi = [];
        $pembobotan = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $krit) {
                foreach ($krit->subkriterias as $sub) {
                    $nilai = PerbandinganAlternatif::where('alternatif_id', $alt->id)
                        ->where('sub_kriteria_id', $sub->id)
                        ->first();

                    $penilaian[$alt->id][$sub->id] = $nilai->nilai ?? null;
                    $normalisasi[$alt->id][$sub->id] = $nilai->normalisasi ?? null;
                    $pembobotan[$alt->id][$sub->id] = $nilai->pembobotan ?? null;
                }
            }
        }

        return view('ahp.alternatif.penilaian', compact('alternatifs', 'kriterias', 'penilaian', 'normalisasi', 'pembobotan'));
    }




    public function simpanPenilaian(Request $request)
    {
        $data = $request->input('nilai'); // array[nama_alternatif][sub_kriteria_id] = nilai

        try {
            foreach ($data as $alternatif_id => $subkriterias) {
                foreach ($subkriterias as $subkriteria_id => $nilai) {
                    // Validasi nilai kosong atau tidak valid
                    if ($nilai === null || $nilai === '') {
                        continue;
                    }

                    PerbandinganAlternatif::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif_id,
                            'sub_kriteria_id' => $subkriteria_id,
                        ],
                        [
                            'nilai' => $nilai,
                        ]
                    );

                    // Hitung akar pembagi untuk normalisasi
                    $akarPembagi = sqrt(PerbandinganAlternatif::where('sub_kriteria_id', $subkriteria_id)
                        ->sum(DB::raw('pow(nilai, 2)')));

                    // Hitung normalisasi
                    $normalisasi = $akarPembagi != 0 ? $nilai / $akarPembagi : 0;

                    // Ambil bobot subkriteria
                    $bobot = SubKriteria::find($subkriteria_id)->bobot ?? 0;

                    // Hitung pembobotan
                    $pembobotan = $normalisasi * $bobot;

                    // Update nilai normalisasi & pembobotan ke tabel
                    PerbandinganAlternatif::where([
                        'alternatif_id' => $alternatif_id,
                        'sub_kriteria_id' => $subkriteria_id,
                    ])->update([
                        'normalisasi' => round($normalisasi, 4),
                        'pembobotan' => round($pembobotan, 4),
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Penilaian alternatif berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan penilaian: ' . $e->getMessage());
        }
    }
}
