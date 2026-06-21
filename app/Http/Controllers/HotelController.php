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
        if (!$cari_check_in) {
            $cari_check_in = date('Y-m-d');
        }

        if (!$cari_check_out) {
            $cari_check_out = date('Y-m-d');
        }

        $histori = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->select(
                'hk.nama_tamu',
                'hk.id_laporan_keuangan',
                'hk.check_in',
                'hk.check_out',
                DB::raw('GROUP_CONCAT(nk.nomor_kamar ORDER BY nk.nomor_kamar SEPARATOR ", ") as nomor_kamar'),
                DB::raw('GROUP_CONCAT(k.kode_kamar SEPARATOR ", ") as tipe_kamar'),
                DB::raw('COUNT(nk.id_nomor_kamar) as jumlah_kamar')
            )
            ->whereDate('hk.check_in', '<=', $cari_check_out)
            ->whereDate('hk.check_out', '>=', $cari_check_in)
            ->groupBy(
                'hk.nama_tamu',
                'hk.id_laporan_keuangan',
                'hk.check_in',
                'hk.check_out'
            )
            ->orderBy('hk.check_in', 'desc')
            ->get();


        // tentukan status otomatis
        $today = Carbon::today();

        foreach ($histori as $row) {

            if ($today < Carbon::parse($row->check_in)) {
                $row->status = 'booking';
            } else {
                $row->status = 'check_in';
            }
        }


        // filter status jika dipilih
        if ($status) {
            $histori = $histori->filter(function ($item) use ($status) {
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
                    ->whereDate('hk.check_out', '>', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'STD')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();
        $kamarTersediaSTD = $kamarSTD->whereNull('histori_aktif')->count();
        $kamarSingleSTD = $kamarSTD
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 1)
            ->count();

        $kamarDoubleSTD = $kamarSTD
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 2)
            ->count();



        return view('index', compact('kamarDLX', 'kamarSingleDLX', 'kamarDoubleDLX', 'kamarSPR', 'kamarSingleSPR', 'kamarDoubleSPR', 'kamarSTD', 'kamarSingleSTD', 'kamarDoubleSTD', 'histori'));
    }







    public function getKamarTersedia(Request $request)
    {
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        if (!$checkIn || !$checkOut) {
            return response()->json([]);
        }

        $kamarTersedia = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')

            ->whereNotIn('nk.id_nomor_kamar', function ($q) use ($checkIn, $checkOut) {

                $q->select('id_nomor_kamar')
                    ->from('histori_kamar')

                    // cek kamar yang bentrok tanggal
                    ->where(function ($query) use ($checkIn, $checkOut) {

                        $query->whereDate('check_in', '<', $checkOut)
                            ->whereDate('check_out', '>', $checkIn);

                    });

            })

            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.id_kamar',
                'k.tipe_kamar'
            )

            ->orderBy('k.id_kamar')
            ->orderBy('nk.nomor_kamar')

            ->get();

        return response()->json($kamarTersedia);
    }










    public function getRequestHotel(Request $request)
    {
        $requestType = $request->request_type;

        if ($requestType == 'extra_bed') {

            $data = DB::table('kamar')
                ->where('kode_kamar', 'BED')
                ->select(
                    'id_kamar',
                    'kode_kamar',
                    'tarif_per_hari'
                )
                ->first();

        } elseif ($requestType == 'breakfast') {

            $data = DB::table('kamar')
                ->where('kode_kamar', 'FAST')
                ->select(
                    'id_kamar',
                    'kode_kamar',
                    'tarif_per_hari'
                )
                ->first();

        } else {

            $data = null;
        }

        return response()->json($data);
    }













    public function getBiayaRequest()
    {
        $extraBed = DB::table('kamar')
            ->where('kode_kamar', 'BED')
            ->first();

        $breakfast = DB::table('kamar')
            ->where('kode_kamar', 'FAST')
            ->first();

        return response()->json([
            'extra_bed' => $extraBed->tarif_per_hari ?? 0,
            'breakfast' => $breakfast->tarif_per_hari ?? 0
        ]);
    }















    public function ModalInfo(Request $request)
    {
        $id = $request->id_laporan_keuangan;

        // Ambil data laporan keuangan
        $data = DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->first();


        // klasifikasi request tambahan
        switch ($data->biaya_tambahan ?? 0) {
            case 150000:
                $requestTambahan = "Extra Bed";
                break;
            case 50000:
                $requestTambahan = "Breakfast";
                break;
            default:
                $requestTambahan = "-";
        }

        // Ambil daftar kamar yang dipesan
        $kamar = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->select(
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'nk.id_kamar'
            )
            ->where('hk.id_laporan_keuangan', $id)
            ->get();

        return view('ModalInfo', [
            'data' => $data,
            'kamar' => $kamar,
            'requestTambahan' => $requestTambahan
        ]);
    }








    public function ModalResi(Request $request)
    {
        $id = $request->id_laporan_keuangan;

        $data = DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->first();


        // klasifikasi request tambahan
        switch ($data->biaya_tambahan ?? 0) {
            case 150000:
                $requestTambahan = "Extra Bed";
                break;
            case 50000:
                $requestTambahan = "Breakfast";
                break;
            default:
                $requestTambahan = "-";
        }


        // Ambil daftar kamar yang dipesan
        $kamar = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->select(
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'nk.id_kamar'
            )
            ->where('hk.id_laporan_keuangan', $id)
            ->get();

        return view('ModalResi', [
            'data' => $data,
            'kamar' => $kamar,
            'requestTambahan' => $requestTambahan
        ]);
    }









    public function PesanKamar(Request $request)
    {
        return view('PesanKamar');
    }







    public function KetersediaanKamar(Request $request)
    {
        return view('KetersediaanKamar');
    }






    public function InformasiPemesanan(Request $request)
    {
        return view('InformasiPemesanan');
    }





    public function DataMaster(Request $request)
    {
        return view('DataMaster');
    }












    public function TambahModalDLX(Request $request)
    {
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalDLX', compact('tipe_kamar'));
    }



    public function store_PesanKamar(Request $request)
    {
        DB::beginTransaction();

        try {

            // =====================================
            // AMBIL DATA KAMAR DARI PILIHAN PERTAMA
            // =====================================
            $kamarUtama = DB::table('nomor_kamar as nk')
                ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
                ->where('nk.id_nomor_kamar', $request->id_nomor_kamar[0])
                ->select(
                    'k.id_kamar',
                    'k.kode_kamar',
                    'k.tipe_kamar',
                    'k.tarif_per_hari',
                    'k.before_10_persen',
                    'k.after_10_persen'
                )
                ->first();

            if (!$kamarUtama) {
                throw new \Exception('Data kamar tidak ditemukan');
            }

            // =====================================
            // LAMA INAP
            // =====================================
            $checkIn = \Carbon\Carbon::parse($request->check_in);
            $checkOut = \Carbon\Carbon::parse($request->check_out);

            $lama_inap = $checkOut->diffInDays($checkIn);

            // =====================================
            // JUMLAH KAMAR
            // =====================================
            $jumlah_kamar = count($request->id_nomor_kamar);

            // =====================================
            // BIAYA TAMBAHAN
            // =====================================
            $biaya_tambahan = $request->biaya_request ?? 0;

            // =====================================
            // HITUNG BIAYA
            // =====================================
            $biaya =
                $jumlah_kamar *
                $kamarUtama->after_10_persen *
                $lama_inap;

            $pajak = $biaya * 0.19;

            $total_diterima =
                ($biaya - $pajak) +
                $biaya_tambahan;

            /* ===============================
               UPLOAD FOTO KTP
            ================================*/
            $foto_ktp = null;


            if ($request->hasFile('foto_ktp')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $nama = str_replace(' ', '_', $request->nama_tamu);
                $foto_ktp = "Foto_KTP_" . $nama . "_" . $timestamp . "." . $request->file('foto_ktp')->extension();
                $storagePath = 'public/uploads/foto_ktp/';
                $request->file('foto_ktp')->storeAs($storagePath, $foto_ktp);
                $publicPath = public_path('storage/uploads/foto_ktp/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $foto_ktp);
                $destinationFile = public_path('storage/uploads/foto_ktp/' . $foto_ktp);
                copy($sourceFile, $destinationFile);
            }

            /* ===============================
               UPLOAD BUKTI PEMBAYARAN
            ================================*/
            $bukti_pembayaran = null;


            if ($request->hasFile('bukti_pembayaran')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $nama = str_replace(' ', '_', $request->nama_tamu);
                $bukti_pembayaran = "Bukti Pembayaran_" . $nama . "_" . $timestamp . "." . $request->file('bukti_pembayaran')->extension();
                $storagePath = 'public/uploads/bukti_pembayaran/';
                $request->file('bukti_pembayaran')->storeAs($storagePath, $bukti_pembayaran);
                $publicPath = public_path('storage/uploads/bukti_pembayaran/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $bukti_pembayaran);
                $destinationFile = public_path('storage/uploads/bukti_pembayaran/' . $bukti_pembayaran);
                copy($sourceFile, $destinationFile);
            }





            // =====================================
            // METODE PEMBAYARAN
            // =====================================
            if ($request->metode_pembayaran == 'online') {

                $metode_pembayaran =
                    $request->sumber_pembayaran;

            } else {

                $metode_pembayaran = 'Cash';
            }

            // =====================================
            // INSERT LAPORAN KEUANGAN
            // =====================================
            $id_laporan =
                DB::table('laporan_keuangan')
                    ->insertGetId([

                        'kode_kamar' =>
                            $kamarUtama->kode_kamar,

                        'nama_tamu' =>
                            $request->nama_tamu,

                        'tipe_kamar' =>
                            $kamarUtama->tipe_kamar,

                        'jumlah_kamar_dipesan' =>
                            $jumlah_kamar,

                        'tarif_per_hari' =>
                            $kamarUtama->tarif_per_hari,

                        'before_10_persen' =>
                            $kamarUtama->before_10_persen,

                        'after_10_persen' =>
                            $kamarUtama->after_10_persen,

                        'tanggal_dipesan' =>
                            now(),

                        'check_in' =>
                            $request->check_in,

                        'check_out' =>
                            $request->check_out,

                        'lama_inap' =>
                            $lama_inap,

                        'biaya' =>
                            $biaya,

                        'biaya_tambahan' =>
                            $biaya_tambahan,

                        'pajak' =>
                            $pajak,

                        'total_diterima' =>
                            $total_diterima,

                        'foto_ktp' =>
                            $foto_ktp,

                        'metode_pembayaran' =>
                            $metode_pembayaran,

                        'bukti_pembayaran' =>
                            $bukti_pembayaran
                    ]);

            // =====================================
            // INSERT HISTORI KAMAR
            // =====================================
            foreach ($request->id_nomor_kamar as $idNomorKamar) {

                DB::table('histori_kamar')->insert([

                    'id_laporan_keuangan' =>
                        $id_laporan,

                    'id_nomor_kamar' =>
                        $idNomorKamar,

                    'nama_tamu' =>
                        $request->nama_tamu,

                    'check_in' =>
                        $request->check_in,

                    'check_out' =>
                        $request->check_out
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

















    public function TambahModalSPR(Request $request)
    {
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalSPR', compact('tipe_kamar'));
    }


    public function store_TambahModalSPR(Request $request)
    {
        DB::beginTransaction();

        try {

            // ==============================
            // 1. KONVERSI TIPE KAMAR
            // ==============================
            if ($request->tipe_kamar == 2) {
                $kode_kamar = 'SPR';
                $tipe_kamar = 'Superior';
                $tarif_per_hari = 280000;
                $before_10_persen = 369000;
                $after_10_persen = 332100;
            }

            // ==============================
            // 2. LAMA INAP
            // ==============================
            $checkIn = \Carbon\Carbon::parse($request->check_in_spr);
            $checkOut = \Carbon\Carbon::parse($request->check_out_spr);
            $lama_inap = $checkOut->diffInDays($checkIn);

            // ==============================
            // 3. JUMLAH KAMAR
            // ==============================
            $jumlah_kamar = $request->jumlah_kamar_dipesan_spr;

            // ==============================
            // 4. REQUEST TAMBAHAN
            // ==============================
            $biaya_request = $request->input('biaya_request_spr', 0);

            // ==============================
            // 5. HITUNG BIAYA
            // ==============================
            $biaya = $jumlah_kamar * $after_10_persen * $lama_inap;

            $pajak = $biaya * 0.19;

            $total_diterima = ($biaya - $pajak) + $biaya_request;




            /* ===============================
               UPLOAD FOTO KTP
            ================================*/
            $foto_ktp_spr = null;


            if ($request->hasFile('foto_ktp_spr')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $nama = str_replace(' ', '_', $request->nama_tamu_spr);
                $foto_ktp_spr = "Foto_KTP_" . $nama . "_" . $timestamp . "." . $request->file('foto_ktp_spr')->extension();
                $storagePath = 'public/uploads/foto_ktp/';
                $request->file('foto_ktp_spr')->storeAs($storagePath, $foto_ktp_spr);
                $publicPath = public_path('storage/uploads/foto_ktp/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $foto_ktp_spr);
                $destinationFile = public_path('storage/uploads/foto_ktp/' . $foto_ktp_spr);
                copy($sourceFile, $destinationFile);
            }



            // ==============================
            // METODE PEMBAYARAN
            // ==============================
            if ($request->metode_pembayaran_spr == 'online') {
                $metode_pembayaran = $request->sumber_pembayaran_spr; // ambil input user
            } else {
                $metode_pembayaran = 'Cash';
            }



            // ==============================
            // 6. INSERT LAPORAN KEUANGAN
            // ==============================
            $id_laporan = DB::table('laporan_keuangan')->insertGetId([
                'kode_kamar' => $kode_kamar,
                'nama_tamu' => $request->nama_tamu_spr,
                'tipe_kamar' => $tipe_kamar,
                'jumlah_kamar_dipesan' => $jumlah_kamar,
                'tarif_per_hari' => $tarif_per_hari,
                'before_10_persen' => $before_10_persen,
                'after_10_persen' => $after_10_persen,
                'check_in' => $request->check_in_spr,
                'check_out' => $request->check_out_spr,
                'lama_inap' => $lama_inap,
                'biaya' => $biaya,
                'biaya_tambahan' => $biaya_request,
                'pajak' => $pajak,
                'total_diterima' => $total_diterima,
                'foto_ktp' => $foto_ktp_spr,



                // ✅ TAMBAHAN BARU
                'tanggal_dipesan' => $request->tanggal_pesan_spr ?? now(),
                'metode_pembayaran' => $metode_pembayaran
            ]);

            // ==============================
            // 7. INSERT HISTORI KAMAR
            // ==============================
            foreach ($request->jenis_bed as $bed) {

                $kamar = DB::table('nomor_kamar as nk')
                    ->where('nk.id_kamar', $request->tipe_kamar) // filter tipe kamar
                    ->where('nk.jenis_bed', $bed) // filter jenis bed
                    ->whereNotIn('nk.id_nomor_kamar', function ($q) use ($request) {
                        $q->select('id_nomor_kamar')
                            ->from('histori_kamar')
                            ->whereDate('check_in', '<=', $request->check_out_spr)
                            ->whereDate('check_out', '>=', $request->check_in_spr);
                    })
                    ->orderBy('nk.id_nomor_kamar') // supaya konsisten ambil kamar pertama
                    ->first();

                if (!$kamar) {
                    throw new \Exception('Kamar dengan tipe dan bed tersebut tidak tersedia');
                }

                DB::table('histori_kamar')->insert([
                    'id_laporan_keuangan' => $id_laporan,
                    'id_nomor_kamar' => $kamar->id_nomor_kamar,
                    'nama_tamu' => $request->nama_tamu_spr,
                    'check_in' => $request->check_in_spr,
                    'check_out' => $request->check_out_spr,
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





























    public function TambahModalSTD(Request $request)
    {
        $tipe_kamar = $request->tipe_kamar;
        return view('TambahModalSTD', compact('tipe_kamar'));
    }



    public function store_TambahModalSTD(Request $request)
    {
        DB::beginTransaction();

        try {

            // ==============================
            // 1. KONVERSI TIPE KAMAR
            // ==============================
            if ($request->tipe_kamar == 3) {
                $kode_kamar = 'STD';
                $tipe_kamar = 'Standar';
                $tarif_per_hari = 240000;
                $before_10_persen = 310000;
                $after_10_persen = 279000;
            }

            // ==============================
            // 2. LAMA INAP
            // ==============================
            $checkIn = \Carbon\Carbon::parse($request->check_in_std);
            $checkOut = \Carbon\Carbon::parse($request->check_out_std);
            $lama_inap = $checkOut->diffInDays($checkIn);

            // ==============================
            // 3. JUMLAH KAMAR
            // ==============================
            $jumlah_kamar = $request->jumlah_kamar_dipesan_std;

            // ==============================
            // 4. REQUEST TAMBAHAN
            // ==============================
            $biaya_request = $request->input('biaya_request_std', 0);

            // ==============================
            // 5. HITUNG BIAYA
            // ==============================
            $biaya = $jumlah_kamar * $after_10_persen * $lama_inap;

            $pajak = $biaya * 0.19;

            $total_diterima = ($biaya - $pajak) + $biaya_request;




            /* ===============================
               UPLOAD FOTO KTP
            ================================*/
            $foto_ktp_std = null;


            if ($request->hasFile('foto_ktp_std')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $nama = str_replace(' ', '_', $request->nama_tamu_std);
                $foto_ktp_std = "Foto_KTP_" . $nama . "_" . $timestamp . "." . $request->file('foto_ktp_std')->extension();
                $storagePath = 'public/uploads/foto_ktp/';
                $request->file('foto_ktp_std')->storeAs($storagePath, $foto_ktp_std);
                $publicPath = public_path('storage/uploads/foto_ktp/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $foto_ktp_std);
                $destinationFile = public_path('storage/uploads/foto_ktp/' . $foto_ktp_std);
                copy($sourceFile, $destinationFile);
            }


            // ==============================
            // METODE PEMBAYARAN
            // ==============================
            if ($request->metode_pembayaran_std == 'online') {
                $metode_pembayaran = $request->sumber_pembayaran_std; // ambil input user
            } else {
                $metode_pembayaran = 'Cash';
            }



            // ==============================
            // 6. INSERT LAPORAN KEUANGAN
            // ==============================
            $id_laporan = DB::table('laporan_keuangan')->insertGetId([
                'kode_kamar' => $kode_kamar,
                'nama_tamu' => $request->nama_tamu_std,
                'tipe_kamar' => $tipe_kamar,
                'jumlah_kamar_dipesan' => $jumlah_kamar,
                'tarif_per_hari' => $tarif_per_hari,
                'before_10_persen' => $before_10_persen,
                'after_10_persen' => $after_10_persen,
                'check_in' => $request->check_in_std,
                'check_out' => $request->check_out_std,
                'lama_inap' => $lama_inap,
                'biaya' => $biaya,
                'biaya_tambahan' => $biaya_request,
                'pajak' => $pajak,
                'total_diterima' => $total_diterima,
                'foto_ktp' => $foto_ktp_std,



                // ✅ TAMBAHAN BARU
                'tanggal_dipesan' => $request->tanggal_pesan_std ?? now(),
                'metode_pembayaran' => $metode_pembayaran
            ]);

            // ==============================
            // 7. INSERT HISTORI KAMAR
            // ==============================
            foreach ($request->jenis_bed as $bed) {

                $kamar = DB::table('nomor_kamar as nk')
                    ->where('nk.id_kamar', $request->tipe_kamar) // filter tipe kamar
                    ->where('nk.jenis_bed', $bed) // filter jenis bed
                    ->whereNotIn('nk.id_nomor_kamar', function ($q) use ($request) {
                        $q->select('id_nomor_kamar')
                            ->from('histori_kamar')
                            ->whereDate('check_in', '<=', $request->check_out_std)
                            ->whereDate('check_out', '>=', $request->check_in_std);
                    })
                    ->orderBy('nk.id_nomor_kamar') // supaya konsisten ambil kamar pertama
                    ->first();

                if (!$kamar) {
                    throw new \Exception('Kamar dengan tipe dan bed tersebut tidak tersedia');
                }

                DB::table('histori_kamar')->insert([
                    'id_laporan_keuangan' => $id_laporan,
                    'id_nomor_kamar' => $kamar->id_nomor_kamar,
                    'nama_tamu' => $request->nama_tamu_std,
                    'check_in' => $request->check_in_std,
                    'check_out' => $request->check_out_std,
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
}
