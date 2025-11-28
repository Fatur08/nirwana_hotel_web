<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalDLX',compact('tipe_kamar'));
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


    public function store_TambahModalDLX(Request $request)
    {
        DB::beginTransaction();

        try {

            // ==============================
            // 1. KONVERSI TIPE KAMAR
            // ==============================
            if ($request->tipe_kamar == 1) {
                $kode_kamar = 'DLX';
                $tipe_kamar = 'Deluxe';
                $tarif_per_hari = 300000;
                $before_10_persen = 397000;
                $after_10_persen = 357300;
            } elseif ($request->tipe_kamar == 2) {
                $kode_kamar = 'SPR';
                $tipe_kamar = 'Superior';
                $tarif_per_hari = 280000;
                $before_10_persen = 369000;
                $after_10_persen = 332100;
            } else {
                $kode_kamar = 'STD';
                $tipe_kamar = 'Standar';
                $tarif_per_hari = 240000;
                $before_10_persen = 310000;
                $after_10_persen = 279000;
            }

            // ==============================
            // 2. LAMA INAP
            // ==============================
            $checkIn  = \Carbon\Carbon::parse($request->check_in);
            $checkOut = \Carbon\Carbon::parse($request->check_out);
            $lama_inap = $checkOut->diffInDays($checkIn);

            // ==============================
            // 3. HITUNG BIAYA
            // ==============================
            $biaya = $request->jumlah_kamar_dipesan * $after_10_persen * $lama_inap;
            $pajak = $biaya * 0.19;
            $biaya_tambahan = $request->biaya_tambahan ?? 0;

            $total_diterima = ($biaya - $pajak) + $biaya_tambahan;

            // ==============================
            // 4. INSERT LAPORAN KEUANGAN
            // ==============================
            $id_laporan = DB::table('laporan_keuangan')->insertGetId([
                'kode_kamar' => $kode_kamar,
                'nama_tamu' => $request->nama_tamu,
                'tipe_kamar' => $tipe_kamar,
                'jumlah_kamar_dipesan' => $request->jumlah_kamar_dipesan,
                'tarif_per_hari' => $tarif_per_hari,
                'before_10_persen' => $before_10_persen,
                'after_10_persen' => $after_10_persen,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'lama_inap' => $lama_inap,
                'biaya' => $biaya,
                'biaya_tambahan' => $biaya_tambahan,
                'pajak' => $pajak,
                'total_diterima' => $total_diterima,
            ]);

            // ==============================
            // 5. INSERT HISTORI KAMAR
            // ==============================
            foreach ($request->nomor_kamar as $idNomorKamar) {
                DB::table('histori_kamar')->insert([
                    'id_laporan_keuangan' => $id_laporan,
                    'id_nomor_kamar' => $idNomorKamar, // sudah integer
                    'nama_tamu' => $request->nama_tamu,
                    'nomor_ktp_tamu' => $request->nomor_ktp_tamu,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                ]);
            }

            DB::commit();

            // ✅ INI YANG PENTING → BALIK KE HALAMAN INDEX
            return redirect()
                ->route('index') // ✅ sesuaikan dengan route halaman utama Anda
                ->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
