<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function TambahModalDLX(Request $request)
    {
        $nomor_kamar = $request->nomor_kamar;

        // Ambil kamar yang masih tersedia
        $kamar_DLX = DB::table('nomor_kamar')
            ->join('kamar', 'nomor_kamar.id_kamar', '=', 'kamar.id_kamar')
            ->where('nomor_kamar.status_dipesan', 0)
            ->where('nomor_kamar.id_kamar', 1)
            ->select(
                'nomor_kamar.nomor_kamar',
                'kamar.kode_kamar'
            )
            ->get();
            
        $kamar_SPR = DB::table('nomor_kamar')
            ->join('kamar', 'nomor_kamar.id_kamar', '=', 'kamar.id_kamar')
            ->where('nomor_kamar.status_dipesan', 0)
            ->where('nomor_kamar.id_kamar', 2)
            ->select(
                'nomor_kamar.nomor_kamar',
                'kamar.kode_kamar'
            )
            ->get();
            
        $kamar_STD = DB::table('nomor_kamar')
            ->join('kamar', 'nomor_kamar.id_kamar', '=', 'kamar.id_kamar')
            ->where('nomor_kamar.status_dipesan', 0)
            ->where('nomor_kamar.id_kamar', 3)
            ->select(
                'nomor_kamar.nomor_kamar',
                'kamar.kode_kamar'
            )
            ->get();

        return view('TambahModalDLX',compact('nomor_kamar', 'kamar_DLX', 'kamar_SPR', 'kamar_STD'));
    }
}
