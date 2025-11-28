<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $cari_tanggal = $request->cari_tanggal;
        
        $kamarDLX = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->where('k.kode_kamar', 'DLX')
            ->select('nk.id_nomor_kamar', 'nk.nomor_kamar', 'k.kode_kamar')
            ->get();

        $kamarSPR = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->where('k.kode_kamar', 'SPR')
            ->select('nk.id_nomor_kamar', 'nk.nomor_kamar', 'k.kode_kamar')
            ->get();

        $kamarSTD = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->where('k.kode_kamar', 'STD')
            ->select('nk.id_nomor_kamar', 'nk.nomor_kamar', 'k.kode_kamar')
            ->get();

        return view('index', compact('cari_tanggal', 'kamarDLX', 'kamarSPR', 'kamarSTD'));
    }
    
    
    public function TambahModalDLX(Request $request)
    {
        $nomor_kamar = $request->nomor_kamar;
        return view('TambahModalDLX',compact('nomor_kamar'));
    }

    public function getKamarTersedia(Request $request)
    {
        $tanggal = $request->tanggal;
        $tipe = $request->tipe_kamar;
    
        // ✅ PROTEKSI AGAR TIDAK ERROR
        if (!$tanggal || !$tipe) {
            return response()->json([]);
        }
    
        $kamarTersedia = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->where('k.id_kamar', $tipe)
            ->whereNotIn('nk.id_nomor_kamar', function($q) use ($tanggal){
                $q->select('id_nomor_kamar')
                  ->from('histori_kamar')
                  ->whereDate('check_in', '<=', $tanggal)
                  ->whereDate('check_out', '>', $tanggal);
            })
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'k.kode_kamar',
                'k.tipe_kamar'
            )
            ->get();
            
        return response()->json($kamarTersedia);
    }
}
