<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        // ambil data dari form
        $cari_check_in = $request->cari_check_in;
        $cari_check_out = $request->cari_check_out;
        $status = $request->status;
        // default jika kosong
        if(!$cari_check_in){
            $cari_check_in = date('Y-m-d');
        }

        if(!$cari_check_out){
            $cari_check_out = date('Y-m-d');
        }

        $histori = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk','hk.id_nomor_kamar','=','nk.id_nomor_kamar')
            ->join('kamar as k','nk.id_kamar','=','k.id_kamar')
            ->select(
                'hk.nama_tamu',
                'hk.check_in',
                'hk.check_out',
                DB::raw('GROUP_CONCAT(nk.nomor_kamar ORDER BY nk.nomor_kamar SEPARATOR ", ") as nomor_kamar'),
                DB::raw('GROUP_CONCAT(k.kode_kamar SEPARATOR ", ") as tipe_kamar'),
                DB::raw('COUNT(nk.id_nomor_kamar) as jumlah_kamar')
            )
            ->whereDate('hk.check_in','<=',$cari_check_out)
            ->whereDate('hk.check_out','>=',$cari_check_in)
            ->groupBy('hk.nama_tamu','hk.check_in','hk.check_out')
            ->orderBy('hk.check_in','desc')
            ->get();


        // tentukan status otomatis
        $today = Carbon::today();

        foreach($histori as $row){

            if($today < Carbon::parse($row->check_in)){
                $row->status = 'booking';
            }else{
                $row->status = 'check_in';
            }

        }


        // filter status jika dipilih
        if($status){
            $histori = $histori->filter(function($item) use ($status){
                return $item->status == $status;
            });
        }

        $tanggalHariIni = Carbon::today();

        $kamarDLX = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($tanggalHariIni) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $tanggalHariIni)
                     ->whereDate('hk.check_out', '>', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'DLX')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();
        $kamarTersediaDLX = $kamarDLX->whereNull('histori_aktif')->count();
        $kamarSingleDLX = $kamarDLX
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 1)
            ->count();

        $kamarDoubleDLX = $kamarDLX
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 2)
            ->count();
            






        
        $kamarSPR = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($tanggalHariIni) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $tanggalHariIni)
                     ->whereDate('hk.check_out', '>', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'SPR')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();
        $kamarTersediaSPR = $kamarSPR->whereNull('histori_aktif')->count();
        $kamarSingleSPR = $kamarSPR
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 1)
            ->count();

        $kamarDoubleSPR = $kamarSPR
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 2)
            ->count();






        $kamarSTD = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($tanggalHariIni) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                     ->whereDate('hk.check_in', '<=', $tanggalHariIni)
                     ->whereDate('hk.check_out', '>=', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'STD')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();

        return view('index', compact('kamarDLX', 'kamarSingleDLX', 'kamarDoubleDLX', 'kamarSPR', 'kamarSingleSPR', 'kamarDoubleSPR', 'kamarSTD', 'histori'));
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
    
        // ✅ Proteksi agar tidak error
        if (!$tanggal || !$tipe) {
            return response()->json([]);
        }
    
        $kamarTersedia = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
    
            ->where('k.id_kamar', $tipe)
    
            // ✅ HANYA AMBIL BED 1 ATAU 2
            ->whereIn('nk.jenis_bed', [1,2])
    
            // cek kamar yang sedang terpakai
            ->whereNotIn('nk.id_nomor_kamar', function($q) use ($tanggal){
                $q->select('id_nomor_kamar')
                  ->from('histori_kamar')
                  ->whereDate('check_in', '<=', $tanggal)
                  ->whereDate('check_out', '>', $tanggal);
            })
    
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
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
            $checkIn  = \Carbon\Carbon::parse($request->check_in_dlx);
            $checkOut = \Carbon\Carbon::parse($request->check_out_dlx);
            $lama_inap = $checkOut->diffInDays($checkIn);
    
            // ==============================
            // 3. JUMLAH KAMAR
            // ==============================
            $jumlah_kamar = $request->jumlah_kamar_dipesan_dlx;
    
            // ==============================
            // 4. REQUEST TAMBAHAN
            // ==============================
            $biaya_request = $request->input('biaya_request_dlx', 0);
    
            // ==============================
            // 5. HITUNG BIAYA
            // ==============================
            $biaya = $jumlah_kamar * $after_10_persen * $lama_inap;
    
            $pajak = $biaya * 0.19;
    
            $total_diterima = ($biaya - $pajak) + $biaya_request;




            /* ===============================
               UPLOAD FOTO KTP
            ================================*/
            $foto_ktp_dlx = null;


            if ($request->hasFile('foto_ktp_dlx')) {
                $foto_ktp_dlx = "Foto KTP_".$request->nama_tamu_dlx.".".$request
                    ->file('foto_ktp_dlx')
                    ->getClientOriginalExtension();
                $storagePath = 'public/uploads/foto_ktp/';
                $request->file('foto_ktp_dlx')->storeAs($storagePath, $foto_ktp_dlx);
                $publicPath = public_path('storage/uploads/foto_ktp/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $foto_ktp_dlx);
                $destinationFile = public_path('storage/uploads/foto_ktp/' . $foto_ktp_dlx);
                copy($sourceFile, $destinationFile);
            }
            
            
            // ==============================
            // 6. INSERT LAPORAN KEUANGAN
            // ==============================
            $id_laporan = DB::table('laporan_keuangan')->insertGetId([
                'kode_kamar' => $kode_kamar,
                'nama_tamu' => $request->nama_tamu_dlx,
                'tipe_kamar' => $tipe_kamar,
                'jumlah_kamar_dipesan' => $jumlah_kamar,
                'tarif_per_hari' => $tarif_per_hari,
                'before_10_persen' => $before_10_persen,
                'after_10_persen' => $after_10_persen,
                'check_in' => $request->check_in_dlx,
                'check_out' => $request->check_out_dlx,
                'lama_inap' => $lama_inap,
                'biaya' => $biaya,
                'biaya_tambahan' => $biaya_request,
                'pajak' => $pajak,
                'total_diterima' => $total_diterima,
                'foto_ktp' => $foto_ktp_dlx
            ]);
    
            // ==============================
            // 7. INSERT HISTORI KAMAR
            // ==============================
            foreach ($request->jenis_bed as $bed) {

                $kamar = DB::table('nomor_kamar as nk')
                    ->where('nk.id_kamar', $request->tipe_kamar) // filter tipe kamar
                    ->where('nk.jenis_bed', $bed) // filter jenis bed
                    ->whereNotIn('nk.id_nomor_kamar', function($q) use ($request){
                        $q->select('id_nomor_kamar')
                          ->from('histori_kamar')
                          ->whereDate('check_in','<=',$request->check_out_dlx)
                          ->whereDate('check_out','>=',$request->check_in_dlx);
                    })
                    ->orderBy('nk.id_nomor_kamar') // supaya konsisten ambil kamar pertama
                    ->first();

                if(!$kamar){
                    throw new \Exception('Kamar dengan tipe dan bed tersebut tidak tersedia');
                }

                DB::table('histori_kamar')->insert([
                    'id_laporan_keuangan' => $id_laporan,
                    'id_nomor_kamar' => $kamar->id_nomor_kamar,
                    'nama_tamu' => $request->nama_tamu_dlx,
                    'check_in' => $request->check_in_dlx,
                    'check_out' => $request->check_out_dlx,
                ]);

            }
    
            DB::commit();
    
            return response()->json([
                'status' => 'success'
            ]);
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
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





























    public function TambahModalSTD(Request $request)
    {
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalSTD',compact('tipe_kamar'));
    }




















    public function store_TambahModalSTD(Request $request)
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





















    public function ModalSTD(Request $request)
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
        return view('ModalSTD',compact('nomor_kamar', 'tipe_kamar', 'histori_kamar'));
    }
}
