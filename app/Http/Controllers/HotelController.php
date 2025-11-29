<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $cari_tanggal = $request->cari_tanggal ?? date('Y-m-d');
        if (!$cari_tanggal || !strtotime($cari_tanggal)) {
            $cari_tanggal = date('Y-m-d');
        }

        $kamarDLX = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($cari_tanggal) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $cari_tanggal)
                     ->whereDate('hk.check_out', '>=', $cari_tanggal);
            })
            ->where('k.kode_kamar', 'DLX')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();

        $kamarSPR = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($cari_tanggal) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $cari_tanggal)
                     ->whereDate('hk.check_out', '>=', $cari_tanggal);
            })
            ->where('k.kode_kamar', 'SPR')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();

        $kamarSTD = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($cari_tanggal) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $cari_tanggal)
                     ->whereDate('hk.check_out', '>=', $cari_tanggal);
            })
            ->where('k.kode_kamar', 'STD')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
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

            return redirect('/')->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Data gagal disimpan!');
        }
    }












    public function ModalDLX(Request $request)
    {
        $cari_tanggal = $request->tanggal;
        $nomor_kamar  = $request->nomor_kamar;
        $tipe_kamar   = $request->tipe_kamar;
        $histori_kamar = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->where('hk.id_nomor_kamar', $nomor_kamar)
            ->whereDate('hk.check_in', '<=', $cari_tanggal)
            ->whereDate('hk.check_out', '>=', $cari_tanggal)
            ->select('hk.*', 'nk.nomor_kamar')
            ->first();
        return view('ModalDLX',compact('nomor_kamar', 'tipe_kamar', 'histori_kamar'));
    }










    public function hapusHistoriKamar(Request $request)
    {
        DB::beginTransaction();

        try {
            $histori = DB::table('histori_kamar')
                ->where('id_histori_kamar', $request->id_histori_kamar)
                ->first();

            if (!$histori) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Data histori tidak ditemukan'
                ]);
            }

            // ✅ Ambil laporan keuangan terkait
            $laporan = DB::table('laporan_keuangan')
                ->where('id_laporan_keuangan', $histori->id_laporan_keuangan)
                ->first();

            // ✅ Hapus histori kamar
            DB::table('histori_kamar')
                ->where('id_histori_kamar', $request->id_histori_kamar)
                ->delete();

            // ✅ Jika laporan ditemukan, update jumlah kamar
            if ($laporan) {

                if ($laporan->jumlah_kamar_dipesan > 1) {
                    // ✅ Jika sebelumnya > 1 → kurangi 1
                    DB::table('laporan_keuangan')
                        ->where('id_laporan_keuangan', $laporan->id_laporan_keuangan)
                        ->update([
                            'jumlah_kamar_dipesan' => $laporan->jumlah_kamar_dipesan - 1
                        ]);
                } else {
                    // ✅ Jika tersisa 0 → hapus laporan keuangan
                    DB::table('laporan_keuangan')
                        ->where('id_laporan_keuangan', $laporan->id_laporan_keuangan)
                        ->delete();
                }
            }

            DB::commit();
            return redirect('/')->with('success', 'Data kamar berhasil dihapus & laporan diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Data kamar gagal dihapus & laporan diperbarui');
        }
    }












    public function TambahModalSPR(Request $request)
    {
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalSPR',compact('tipe_kamar'));
    }




















    public function store_TambahModalSPR(Request $request)
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

            return redirect('/')->with('success', 'Data berhasil disimpan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('/')->with('error', 'Data gagal disimpan!');
        }
    }





















    public function ModalSPR(Request $request)
    {
        $cari_tanggal = $request->tanggal;
        $nomor_kamar  = $request->nomor_kamar;
        $tipe_kamar   = $request->tipe_kamar;
        $histori_kamar = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->where('hk.id_nomor_kamar', $nomor_kamar)
            ->whereDate('hk.check_in', '<=', $cari_tanggal)
            ->whereDate('hk.check_out', '>=', $cari_tanggal)
            ->select('hk.*', 'nk.nomor_kamar')
            ->first();
        return view('ModalSPR',compact('nomor_kamar', 'tipe_kamar', 'histori_kamar'));
    }
}
