<?php

namespace App\Http\Controllers\ahli\hama;

use App\Http\Controllers\Controller;
use App\Models\AlternatifHama;
use App\Models\KriteriaHama;
use App\Models\PenilaianAlternatifHama;
use App\Models\SubKriteriaHama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class alternatifHamaController extends Controller
{
    public function index()
    {
        $alternatif = AlternatifHama::orderBy('created_at', 'asc')->get();
        return view('ahli.hama.alternatif.alternatif', compact('alternatif'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode'              => 'required',
                'nama'              => 'required',
            ]);

            AlternatifHama::create($validated);
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

            $alternatif = AlternatifHama::findOrFail($id);
            $alternatif->update($validated);

            return redirect()->back()->with('success', 'Jabatan berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui Jabatan. Silakan coba lagi.' . $th->getMessage());
        }
    }

    public function delete($id)
    {
        $alternatif = AlternatifHama::findOrFail($id);
        $alternatif->delete();

        return back()->with('success', 'data telah dihapus');
    }


    public function tampilPenilaianAlternatif()
    {
        $alternatifs = AlternatifHama::all();
        $kriterias = KriteriaHama::with('subkriterias')->get();

        // Ambil nilai penilaian jika sudah pernah diisi
        $penilaian = [];
        $normalisasi = [];
        $pembobotan = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $krit) {
                foreach ($krit->subkriterias as $sub) {
                    $nilai = PenilaianAlternatifHama::where('alternatif_id', $alt->id)
                        ->where('sub_kriteria_id', $sub->id)
                        ->first();

                    $penilaian[$alt->id][$sub->id] = $nilai->nilai ?? null;
                    $normalisasi[$alt->id][$sub->id] = $nilai->normalisasi ?? null;
                    $pembobotan[$alt->id][$sub->id] = $nilai->pembobotan ?? null;
                }
            }
        }

        return view('ahli.hama.alternatif.penilaian', compact('alternatifs', 'kriterias', 'penilaian', 'normalisasi', 'pembobotan'));
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

                    PenilaianAlternatifHama::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif_id,
                            'sub_kriteria_id' => $subkriteria_id,
                        ],
                        [
                            'nilai' => $nilai,
                        ]
                    );

                    // Hitung akar pembagi untuk normalisasi
                    $akarPembagi = sqrt(PenilaianAlternatifHama::where('sub_kriteria_id', $subkriteria_id)
                        ->sum(DB::raw('pow(nilai, 2)')));

                    // Hitung normalisasi
                    $normalisasi = $akarPembagi != 0 ? $nilai / $akarPembagi : 0;

                    // Ambil bobot subkriteria
                    $bobot = SubKriteriaHama::find($subkriteria_id)->bobot ?? 0;

                    // Hitung pembobotan
                    $pembobotan = $normalisasi * $bobot;

                    // Update nilai normalisasi & pembobotan ke tabel
                    PenilaianAlternatifHama::where([
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
