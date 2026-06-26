<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar;
use App\Models\NomorKamar;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        // ambil data dari form
        $cari_check_in = $request->cari_check_in;
        $cari_check_out = $request->cari_check_out;
        $status = $request->status;




        $tarifKamar = Kamar::select('kode_kamar', 'tarif_per_hari')
            ->get()
            ->keyBy('kode_kamar');


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



        return view('index', compact('kamarDLX', 'kamarSingleDLX', 'kamarDoubleDLX', 'kamarSPR', 'kamarSingleSPR', 'kamarDoubleSPR', 'kamarSTD', 'kamarSingleSTD', 'kamarDoubleSTD', 'histori', 'tarifKamar'));
    }














    // Modal Pesan Kamar
    public function PesanKamar(Request $request)
    {
        return view('PesanKamar');
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

            // Ambil tarif Extra Bed
            $extraBed = DB::table('kamar')
                ->where('kode_kamar', 'BED')
                ->first();

            // Ambil tarif Breakfast
            $breakfast = DB::table('kamar')
                ->where('kode_kamar', 'FAST')
                ->first();

            $jumlahExtraBed = (int) $request->jumlah_extra_bed;
            $jumlahBreakfast = (int) $request->jumlah_breakfast;

            $totalExtraBed = $jumlahExtraBed * ($extraBed->tarif_per_hari ?? 0);
            $totalBreakfast = $jumlahBreakfast * ($breakfast->tarif_per_hari ?? 0);

            $biaya_tambahan =
                $totalExtraBed +
                $totalBreakfast;

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

            $status_pembayaran =
                $request->status_pembayaran == 'sudah'
                ? 1
                : 0;
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
                            $bukti_pembayaran,

                        'status_pembayaran' =>
                            $status_pembayaran
                    ]);




            // =====================================
            // INSERT REQUEST TAMBAHAN
            // =====================================

            // Extra Bed
            if ($jumlahExtraBed > 0) {

                DB::table('request')->insert([

                    'id_laporan_keuangan' => $id_laporan,

                    'kode_request' => 'BED',

                    'jumlah_request' => $jumlahExtraBed,

                    'total_harga' => $totalExtraBed

                ]);

            }

            // Breakfast
            if ($jumlahBreakfast > 0) {

                DB::table('request')->insert([

                    'id_laporan_keuangan' => $id_laporan,

                    'kode_request' => 'FAST',

                    'jumlah_request' => $jumlahBreakfast,

                    'total_harga' => $totalBreakfast

                ]);

            }





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

                    'alamat_tamu' =>
                        $request->alamat_tamu,

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















    public function KetersediaanKamar(Request $request)
    {
        // Ambil bulan dan tahun dari form
        $bulan = $request->bulan ?? date('n');
        $tahun = $request->tahun ?? date('Y');

        // Jumlah hari dalam bulan yang dipilih
        $jumlahHari = Carbon::create(
            $tahun,
            $bulan,
            1
        )->daysInMonth;

        // Nama bulan
        $namaBulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ][$bulan];

        // Ambil seluruh nomor kamar
        $nomorKamar = NomorKamar::orderBy('id_nomor_kamar')
            ->get();


        $bookingKamar = DB::table('histori_kamar as hk')
            ->join(
                'laporan_keuangan as lk',
                'hk.id_laporan_keuangan',
                '=',
                'lk.id_laporan_keuangan'
            )
            ->select(
                'hk.id_nomor_kamar',
                'hk.id_laporan_keuangan',
                'hk.check_in',
                'hk.check_out',
                'lk.status_pembayaran'
            )
            ->get();

        return view('KetersediaanKamar', compact(
            'nomorKamar',
            'jumlahHari',
            'bulan',
            'tahun',
            'namaBulan',
            'bookingKamar'
        ));
    }






    public function InformasiPemesanan(Request $request)
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
            ->join(
                'laporan_keuangan as lk',
                'hk.id_laporan_keuangan',
                '=',
                'lk.id_laporan_keuangan'
            )
            ->select(
                'hk.nama_tamu',
                'hk.id_laporan_keuangan',
                'hk.check_in',
                'hk.check_out',

                // TAMBAHKAN INI
                'lk.status_pembayaran',

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
                'hk.check_out',

                // WAJIB DITAMBAHKAN
                'lk.status_pembayaran'
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
        return view('InformasiPemesanan', compact('histori'));
    }









    public function ModalInfo(Request $request)
    {
        $id = $request->id_laporan_keuangan;

        // Ambil data laporan keuangan
        $data = DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->first();


        // klasifikasi request tambahan
        $requestTambahan = DB::table('request as r')
            ->join('kamar as k', 'r.kode_request', '=', 'k.kode_kamar')
            ->select(
                'k.tipe_kamar',
                'r.jumlah_request',
                'r.total_harga'
            )
            ->where('r.id_laporan_keuangan', $id)
            ->get();

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

        // Data transaksi
        $data = DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->first();

        // Ambil data tamu (alamat di histori)
        $histori = DB::table('histori_kamar')
            ->where('id_laporan_keuangan', $id)
            ->first();

        // Lama menginap
        $lama = $data->lama_inap;

        // Ambil seluruh kamar yang dipesan
        $kamar = DB::table('histori_kamar as hk')
            ->join('nomor_kamar as nk', 'hk.id_nomor_kamar', '=', 'nk.id_nomor_kamar')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->select(
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.id_kamar',
                'k.kode_kamar',
                'k.tipe_kamar',
                'k.tarif_per_hari'
            )
            ->where('hk.id_laporan_keuangan', $id)
            ->get();


        $detailKamar = [];

        foreach ($kamar as $item) {

            if (!isset($detailKamar[$item->kode_kamar])) {

                $detailKamar[$item->kode_kamar] = [
                    'nama' => $item->tipe_kamar,
                    'jumlah' => 0,
                    'tarif' => $item->tarif_per_hari,
                    'subtotal' => 0,
                    'nomor_kamar' => [],
                ];

            }

            $detailKamar[$item->kode_kamar]['jumlah']++;
            $detailKamar[$item->kode_kamar]['nomor_kamar'][] = $item->nomor_kamar;

            $jenisBed = match ($item->jenis_bed) {
                1 => 'Single Bed',
                2 => 'Double Bed',
                default => '-'
            };

            $detailKamar[$item->kode_kamar]['nomor_kamar'][] = [
                'nomor' => $item->nomor_kamar,
                'bed' => $jenisBed
            ];

        }

        foreach ($detailKamar as $kode => $item) {

            $detailKamar[$kode]['subtotal'] =
                $item['jumlah'] *
                $item['tarif'] *
                $lama;

        }


        // Total kamar
        $totalKamar = 0;

        foreach ($detailKamar as $item) {

            $totalKamar += $item['subtotal'];

        }


        $requestTambahan = DB::table('request as r')
            ->join('kamar as k', 'r.kode_request', '=', 'k.kode_kamar')
            ->select(
                'r.kode_request',
                'r.jumlah_request',
                'r.total_harga',
                'k.tipe_kamar',
                'k.tarif_per_hari'
            )
            ->where('r.id_laporan_keuangan', $id)
            ->get();




        // =====================================
        // TOTAL KAMAR
        // =====================================

        $totalKamar = 0;

        foreach ($detailKamar as $item) {

            $totalKamar += $item['subtotal'];

        }


        // =====================================
        // TOTAL REQUEST
        // =====================================

        $totalRequest = $requestTambahan->sum('total_harga');


        // =====================================
        // SUB TOTAL
        // =====================================

        $subTotal = $totalKamar + $totalRequest;


        // =====================================
        // PAJAK
        // =====================================

        $pajak = 0;


        // =====================================
        // GRAND TOTAL
        // =====================================

        $grandTotal = $subTotal + $pajak;

        return view('ModalResi', [

            'data' => $data,

            'histori' => $histori,

            'lama' => $lama,

            'detailKamar' => $detailKamar,

            'requestTambahan' => $requestTambahan,

            'subTotal' => $subTotal,

            'pajak' => $pajak,

            'grandTotal' => $grandTotal

        ]);
    }








    // Modal Pembayaran
    public function ModalPembayaran(Request $request)
    {
        $id_laporan_keuangan = $request->id_laporan_keuangan;
        return view('ModalPembayaran', compact('id_laporan_keuangan'));
    }






    public function store_ModalPembayaran(Request $request)
    {
        try {

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

            // ==========================
            // UPDATE PEMBAYARAN
            // ==========================
            DB::table('laporan_keuangan')
                ->where(
                    'id_laporan_keuangan',
                    $request->id_laporan_keuangan
                )
                ->update([

                    'status_pembayaran' => 1,

                    'metode_pembayaran' =>
                        $request->metode_pembayaran == 'online'
                        ? $request->sumber_pembayaran
                        : null,

                    'bukti_pembayaran' =>
                        $bukti_pembayaran
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil disimpan'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }






    public function BatalkanPembayaran(Request $request, $id)
    {
        $data = DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->first();

        if (!empty($data->bukti_pembayaran)) {

            // Hapus dari storage/app/public
            Storage::delete(
                'public/uploads/bukti_pembayaran/' .
                $data->bukti_pembayaran
            );

            // Hapus dari public/storage
            $filePublic = public_path(
                'storage/uploads/bukti_pembayaran/' .
                $data->bukti_pembayaran
            );

            if (file_exists($filePublic)) {
                unlink($filePublic);
            }
        }

        DB::table('laporan_keuangan')
            ->where('id_laporan_keuangan', $id)
            ->update([
                'status_pembayaran' => 0,
                'metode_pembayaran' => null,
                'bukti_pembayaran' => null
            ]);

        return redirect()->back()->with(
            'success',
            'Pembayaran berhasil dibatalkan'
        );
    }










    // Modal Edit Pesan Kamar
    public function ModalEdit(Request $request)
    {
        return view('ModalEdit');
    }











    public function DataMaster(Request $request)
    {
        $kamar = DB::table('kamar')
            ->pluck('tarif_per_hari', 'kode_kamar')
            ->toArray();

        return view('DataMaster', compact('kamar'));
    }





    public function UpdateDataMaster(Request $request)
    {
        DB::beginTransaction();

        try {

            $data = [
                'DLX',
                'SPR',
                'STD',
                'HMSTY',
                'BED',
                'FAST'
            ];

            foreach ($data as $kode) {

                DB::table('kamar')
                    ->where('kode_kamar', $kode)
                    ->update([
                        'tarif_per_hari' => preg_replace('/[^0-9]/', '', $request->$kode)
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