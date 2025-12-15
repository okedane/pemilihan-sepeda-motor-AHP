<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Hasil;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
     public function history()
    {
        $riwayats = Hasil::with(['alternatif'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        foreach ($riwayats as $riwayat) {

            $ids = is_array($riwayat->sub_kriteria_ids)
                ? $riwayat->sub_kriteria_ids
                : json_decode($riwayat->sub_kriteria_ids, true);


            $riwayat->subkriteria_list = SubKriteria::whereIn('id', $ids ?? [])->get();
        }

        return view('user.history', compact('riwayats'));
    }
}
