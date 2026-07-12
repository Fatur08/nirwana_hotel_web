<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kamar;
use App\Models\NomorKamar;
use Illuminate\Support\Facades\Storage;
use App\Services\WhatsApp\WhatsAppService;
use App\Services\NotifikasiService;

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




        $HomeStay = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($tanggalHariIni) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                    ->whereDate('hk.check_in', '<=', $tanggalHariIni)
                    ->whereDate('hk.check_out', '>', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'HMSTY')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();
        $HomeStayTersedia = $HomeStay->whereNull('histori_aktif')->count();
        $SingleHMSTY = $HomeStay
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 1)
            ->count();

        $DoubleHMSTY = $HomeStay
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



        return view('index', compact('kamarDLX', 'kamarSingleDLX', 'kamarDoubleDLX', 'kamarSPR', 'kamarSingleSPR', 'kamarDoubleSPR', 'kamarSTD', 'kamarSingleSTD', 'kamarDoubleSTD', 'SingleHMSTY', 'DoubleHMSTY', 'histori', 'tarifKamar'));
    }














    // Modal Pesan Kamar
    public function PesanKamar(Request $request)
    {
        $customer = DB::table('rincian_pesanan as rp')
            ->join(
                'histori_kamar as hk',
                'rp.id_rincian_pesanan',
                '=',
                'hk.id_rincian_pesanan'
            )
            ->select(
                DB::raw('MIN(rp.id_rincian_pesanan) as id_rincian_pesanan'),
                'rp.nama_tamu',
                'hk.alamat_tamu',
                'rp.no_wa_tamu'
            )
            ->groupBy(
                'rp.nama_tamu',
                'hk.alamat_tamu',
                'rp.no_wa_tamu'
            )
            ->orderBy('rp.nama_tamu')
            ->get();
        return view('PesanKamar', compact('customer'));
    }











    public function CariCustomer(Request $request)
    {
        $keyword = $request->keyword;

        $customer = DB::table('rincian_pesanan as rp')

            ->join(
                'histori_kamar as hk',
                'rp.id_rincian_pesanan',
                '=',
                'hk.id_rincian_pesanan'
            )

            ->leftJoin(
                'laporan_keuangan as lk',
                'rp.id_rincian_pesanan',
                '=',
                'lk.id_rincian_pesanan'
            )

            ->select(
                'rp.id_rincian_pesanan',
                'rp.nama_tamu',
                'hk.alamat_tamu',
                'rp.no_wa_tamu',
                'lk.foto_ktp'
            )

            ->where('rp.nama_tamu', 'like', '%' . $keyword . '%')

            ->groupBy(
                'rp.id_rincian_pesanan',
                'rp.nama_tamu',
                'hk.alamat_tamu',
                'rp.no_wa_tamu',
                'lk.foto_ktp'
            )

            ->orderBy('rp.nama_tamu')

            ->limit(10)

            ->get();

        return response()->json($customer);
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

                    // kamar yang bentrok tanggal
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












    public function getKamarTersediaEdit(Request $request)
    {
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        $idRincian = $request->id_rincian_pesanan;

        if (!$checkIn || !$checkOut) {
            return response()->json([]);
        }

        $kamarTersedia = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')

            ->whereNotIn('nk.id_nomor_kamar', function ($q) use ($checkIn, $checkOut, $idRincian) {

                $q->select('id_nomor_kamar')
                    ->from('histori_kamar')

                    ->where(function ($query) use ($checkIn, $checkOut) {

                        $query->whereDate('check_in', '<', $checkOut)
                            ->whereDate('check_out', '>', $checkIn);

                    })

                    // <<< BAGIAN PALING PENTING
                    ->where('id_rincian_pesanan', '!=', $idRincian);

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
            /*
            |--------------------------------------------------------------------------
            | UBAH HOME STAY MENJADI 2 NOMOR KAMAR
            |--------------------------------------------------------------------------
            */

            $idNomorKamar = [];

            foreach ($request->id_nomor_kamar as $item) {

                if ($item == "HMSTY") {

                    $homeStay = DB::table('nomor_kamar as nk')
                        ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
                        ->where('k.kode_kamar', 'HMSTY')
                        ->pluck('nk.id_nomor_kamar')
                        ->toArray();

                    $idNomorKamar = array_merge($idNomorKamar, $homeStay);

                } else {

                    $idNomorKamar[] = $item;

                }

            }

            $request->merge([
                'id_nomor_kamar' => $idNomorKamar
            ]);



            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA CUSTOMER
            |--------------------------------------------------------------------------
            */

            $namaTamu = "";
            $alamatTamu = "";
            $noWaTamu = "";

            $foto_ktp = null;

            if ($request->jenis_customer == "baru") {

                $namaTamu = $request->nama_tamu;
                $alamatTamu = $request->alamat_tamu;
                $noWaTamu = $request->no_wa_tamu;

                /*
                |--------------------------------------------------------------------------
                | UPLOAD FOTO KTP CUSTOMER BARU
                |--------------------------------------------------------------------------
                */

                if ($request->hasFile('foto_ktp')) {

                    $timestamp = now()->format('Y-m-d_H-i-s');

                    $namaFile = str_replace(' ', '_', $namaTamu);

                    $foto_ktp =
                        "Foto_KTP_" .
                        $namaFile .
                        "_" .
                        $timestamp .
                        "." .
                        $request->file('foto_ktp')->extension();

                    $storagePath = 'public/uploads/foto_ktp/';

                    $request
                        ->file('foto_ktp')
                        ->storeAs($storagePath, $foto_ktp);

                    $publicPath =
                        public_path('storage/uploads/foto_ktp/');

                    if (!is_dir($publicPath)) {

                        mkdir($publicPath, 0777, true);

                    }

                    copy(
                        storage_path('app/' . $storagePath . $foto_ktp),
                        public_path('storage/uploads/foto_ktp/' . $foto_ktp)
                    );

                }

            } else {

                $customer = DB::table('rincian_pesanan as rp')
                    ->select(
                        'rp.nama_tamu',
                        'rp.no_wa_tamu',
                        DB::raw('(SELECT alamat_tamu
                  FROM histori_kamar
                  WHERE id_rincian_pesanan = rp.id_rincian_pesanan
                  LIMIT 1) as alamat_tamu'),
                        DB::raw('(SELECT foto_ktp
                  FROM laporan_keuangan
                  WHERE id_rincian_pesanan = rp.id_rincian_pesanan
                  LIMIT 1) as foto_ktp')
                    )
                    ->where('rp.id_rincian_pesanan', $request->id_customer_lama)
                    ->first();

                if (!$customer) {

                    throw new Exception("Customer lama tidak ditemukan.");

                }

                $namaTamu = $customer->nama_tamu;
                $alamatTamu = $customer->alamat_tamu;
                $noWaTamu = $customer->no_wa_tamu;
                $foto_ktp = $customer->foto_ktp;

            }



            /*
            |--------------------------------------------------------------------------
            | AMBIL KAMAR
            |--------------------------------------------------------------------------
            */

            $kamarDipilih = DB::table('nomor_kamar as nk')

                ->join(
                    'kamar as k',
                    'nk.id_kamar',
                    '=',
                    'k.id_kamar'
                )

                ->whereIn(
                    'nk.id_nomor_kamar',
                    $request->id_nomor_kamar
                )

                ->select(

                    'nk.id_nomor_kamar',
                    'nk.nomor_kamar',
                    'nk.jenis_bed',

                    'k.id_kamar',
                    'k.kode_kamar',
                    'k.tipe_kamar',
                    'k.tarif_per_hari',
                    'k.before_10_persen',
                    'k.after_10_persen'

                )

                ->get();


            if ($kamarDipilih->isEmpty()) {

                throw new Exception("Data kamar tidak ditemukan.");

            }



            /*
            |--------------------------------------------------------------------------
            | GROUP TIPE KAMAR
            |--------------------------------------------------------------------------
            */

            $groupKamar =
                $kamarDipilih->groupBy('id_kamar');



            /*
            |--------------------------------------------------------------------------
            | LAMA INAP
            |--------------------------------------------------------------------------
            */

            $checkIn =
                \Carbon\Carbon::parse($request->check_in);

            $checkOut =
                \Carbon\Carbon::parse($request->check_out);

            $lama_inap =
                $checkOut->diffInDays($checkIn);



            /*
            |--------------------------------------------------------------------------
            | TOTAL KAMAR
            |--------------------------------------------------------------------------
            */

            $totalKamar =
                count($request->id_nomor_kamar);



            /*
            |--------------------------------------------------------------------------
            | HITUNG REQUEST
            |--------------------------------------------------------------------------
            */

            $extraBed =
                DB::table('kamar')
                    ->where('kode_kamar', 'BED')
                    ->first();

            $breakfast =
                DB::table('kamar')
                    ->where('kode_kamar', 'FAST')
                    ->first();

            $jumlahExtraBed =
                (int) $request->jumlah_extra_bed;

            $jumlahBreakfast =
                (int) $request->jumlah_breakfast;

            $totalExtraBed =
                $jumlahExtraBed *
                ($extraBed->tarif_per_hari ?? 0);

            $totalBreakfast =
                $jumlahBreakfast *
                ($breakfast->tarif_per_hari ?? 0);

            $totalRequest =
                $totalExtraBed +
                $totalBreakfast;



            /*
            |--------------------------------------------------------------------------
            | UPLOAD BUKTI PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $bukti_pembayaran = null;

            if ($request->hasFile('bukti_pembayaran')) {

                $timestamp =
                    now()->format('Y-m-d_H-i-s');

                $namaFile =
                    str_replace(' ', '_', $namaTamu);

                $bukti_pembayaran =
                    "Bukti_Pembayaran_" .
                    $namaFile .
                    "_" .
                    $timestamp .
                    "." .
                    $request->file('bukti_pembayaran')->extension();

                $storagePath =
                    'public/uploads/bukti_pembayaran/';

                $request
                    ->file('bukti_pembayaran')
                    ->storeAs(
                        $storagePath,
                        $bukti_pembayaran
                    );

                $publicPath =
                    public_path(
                        'storage/uploads/bukti_pembayaran/'
                    );

                if (!is_dir($publicPath)) {

                    mkdir($publicPath, 0777, true);

                }

                copy(

                    storage_path(
                        'app/' .
                        $storagePath .
                        $bukti_pembayaran
                    ),

                    public_path(
                        'storage/uploads/bukti_pembayaran/' .
                        $bukti_pembayaran
                    )

                );

            }



            /*
            |--------------------------------------------------------------------------
            | STATUS PEMBAYARAN
            |--------------------------------------------------------------------------
            */

            $status_pembayaran =
                $request->status_pembayaran == "sudah"
                ? 1
                : 0;

            $metode_pembayaran = null;

            if ($status_pembayaran == 1) {

                if ($request->metode_pembayaran == "online") {

                    $metode_pembayaran =
                        $request->sumber_pembayaran;

                } else {

                    $metode_pembayaran = "Cash";

                }

            }

            /*
            |--------------------------------------------------------------------------
            | CUSTOMER BARU / CUSTOMER LAMA
            |--------------------------------------------------------------------------
            */

            if ($request->jenis_customer == "baru") {
                /*
                |--------------------------------------------------------------------------
                | INSERT CUSTOMER BARU
                |--------------------------------------------------------------------------
                */

                $namaTamu = $request->nama_tamu;
                $alamatTamu = $request->alamat_tamu;
                $noWaTamu = $request->no_wa_tamu;

            } else {
                /*
                |--------------------------------------------------------------------------
                | CUSTOMER LAMA
                |--------------------------------------------------------------------------
                */

                $customer = DB::table('rincian_pesanan as rp')
                    ->select(
                        'rp.nama_tamu',
                        'rp.no_wa_tamu',
                        DB::raw('(SELECT alamat_tamu
                FROM histori_kamar
                WHERE id_rincian_pesanan = rp.id_rincian_pesanan
                LIMIT 1) as alamat_tamu'),
                        DB::raw('(SELECT foto_ktp
                FROM laporan_keuangan
                WHERE id_rincian_pesanan = rp.id_rincian_pesanan
                LIMIT 1) as foto_ktp')
                    )
                    ->where('rp.id_rincian_pesanan', $request->id_customer_lama)
                    ->first();

                if (!$customer) {
                    throw new Exception("Customer tidak ditemukan.");
                }

                $namaTamu = $customer->nama_tamu;
                $alamatTamu = $customer->alamat_tamu;
                $noWaTamu = $customer->no_wa_tamu;
                $foto_ktp = $customer->foto_ktp;

            }

            /*
            |--------------------------------------------------------------------------
            | ID RINCIAN
            |--------------------------------------------------------------------------
            */

            $idRincian = DB::table('rincian_pesanan')->insertGetId([

                'nama_tamu' => $namaTamu,
                'no_wa_tamu' => $noWaTamu,
                'total_kamar_dipesan' => $totalKamar,
                'total_request' => $totalRequest

            ]);





            // =====================================
            // INSERT LAPORAN KEUANGAN
            // SATU DATA PER TIPE KAMAR
            // =====================================

            $idLaporanPerKamar = [];

            foreach ($groupKamar as $items) {

                $kamar = $items->first();

                $jumlahPerTipe = $items->count();

                $biaya = $jumlahPerTipe * $kamar->after_10_persen * $lama_inap;

                $pajak = $biaya * 0.19;

                $totalDiterima = $biaya - $pajak;

                $idLaporan = DB::table('laporan_keuangan')->insertGetId([

                    'id_rincian_pesanan' => $idRincian,

                    'kode_kamar' => $kamar->kode_kamar,
                    'nama_tamu' => $namaTamu,
                    'tipe_kamar' => $kamar->tipe_kamar,

                    'jumlah_kamar_dipesan' => $jumlahPerTipe,

                    'tarif_per_hari' => $kamar->tarif_per_hari,
                    'before_10_persen' => $kamar->before_10_persen,
                    'after_10_persen' => $kamar->after_10_persen,

                    'tanggal_dipesan' => now(),

                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'lama_inap' => $lama_inap,

                    'biaya' => $biaya,
                    'biaya_tambahan' => 0,
                    'pajak' => $pajak,
                    'total_diterima' => $totalDiterima,

                    'foto_ktp' => $foto_ktp,

                    'metode_pembayaran' => $metode_pembayaran,
                    'bukti_pembayaran' => $bukti_pembayaran,
                    'status_pembayaran' => $status_pembayaran

                ]);

                foreach ($items as $item) {

                    $idLaporanPerKamar[$item->id_nomor_kamar] = $idLaporan;

                }

            }







            // =====================================
            // INSERT REQUEST TAMBAHAN
            // =====================================

            $requestTambahan = [];

            if ($jumlahExtraBed > 0) {

                $requestTambahan[] = [

                    'id_rincian_pesanan' => $idRincian,
                    'kode_request' => 'BED',
                    'jumlah_request' => $jumlahExtraBed,
                    'total_harga' => $totalExtraBed

                ];

            }

            if ($jumlahBreakfast > 0) {

                $requestTambahan[] = [

                    'id_rincian_pesanan' => $idRincian,
                    'kode_request' => 'FAST',
                    'jumlah_request' => $jumlahBreakfast,
                    'total_harga' => $totalBreakfast

                ];

            }

            if (!empty($requestTambahan)) {

                DB::table('request')->insert($requestTambahan);

            }







            // =====================================
            // INSERT HISTORI KAMAR
            // =====================================

            $dataHistori = [];

            foreach ($request->id_nomor_kamar as $idNomorKamar) {

                $dataHistori[] = [

                    'id_rincian_pesanan' => $idRincian,
                    'id_laporan_keuangan' => $idLaporanPerKamar[$idNomorKamar],
                    'id_nomor_kamar' => $idNomorKamar,

                    'nama_tamu' => $namaTamu,
                    'alamat_tamu' => $alamatTamu,

                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out

                ];

            }

            DB::table('histori_kamar')->insert($dataHistori);







            DB::commit();

            NotifikasiService::buat(
                'Pemesanan Baru',
                'Pemesanan baru atas nama "' . $namaTamu . '" berhasil dibuat.',
                'pemesanan',
                $request->dibuat_oleh
            );

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
                'rincian_pesanan as rp',
                'hk.id_rincian_pesanan',
                '=',
                'rp.id_rincian_pesanan'
            )
            ->leftJoin(
                'laporan_keuangan as lk',
                'rp.id_rincian_pesanan',
                '=',
                'lk.id_rincian_pesanan'
            )
            ->select(
                'hk.id_nomor_kamar',
                'hk.id_rincian_pesanan',
                'hk.check_in',
                'hk.check_out',
                DB::raw('MIN(lk.status_pembayaran) as status_pembayaran')
            )
            ->groupBy(
                'hk.id_nomor_kamar',
                'hk.id_rincian_pesanan',
                'hk.check_in',
                'hk.check_out'
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
        $cari_nama_tamu = $request->cari_nama_tamu;
        $cari_check_in = $request->cari_check_in;
        $cari_check_out = $request->cari_check_out;
        $status = $request->status;

        $query = DB::table('rincian_pesanan as rp')
            ->join(
                'histori_kamar as hk',
                'rp.id_rincian_pesanan',
                '=',
                'hk.id_rincian_pesanan'
            )
            ->leftJoin(
                'laporan_keuangan as lk',
                'rp.id_rincian_pesanan',
                '=',
                'lk.id_rincian_pesanan'
            )
            ->select(
                'rp.id_rincian_pesanan',
                'rp.nama_tamu',
                'rp.total_kamar_dipesan',
                'rp.total_request',
                'hk.check_in',
                'hk.check_out',
                DB::raw('MIN(lk.status_pembayaran) as status_pembayaran')
            )
            ->groupBy(
                'rp.id_rincian_pesanan',
                'rp.nama_tamu',
                'rp.total_kamar_dipesan',
                'rp.total_request',
                'hk.check_in',
                'hk.check_out'
            );

        /*
        |--------------------------------------------------------------------------
        | FILTER NAMA TAMU
        |--------------------------------------------------------------------------
        */

        if ($request->filled('cari_nama_tamu')) {

            $query->where('rp.nama_tamu', 'like', '%' . $cari_nama_tamu . '%');

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER TANGGAL
        |--------------------------------------------------------------------------
        */

        // Check In + Check Out
        if ($request->filled('cari_check_in') && $request->filled('cari_check_out')) {

            $query->whereDate('hk.check_in', $cari_check_in)
                ->orderByRaw("
                CASE
                    WHEN DATE(hk.check_out) = ? THEN 0
                    ELSE 1
                END
            ", [$cari_check_out])
                ->orderBy('hk.check_out', 'asc');

        }

        // Hanya Check In
        elseif ($request->filled('cari_check_in')) {

            $query->whereDate('hk.check_in', $cari_check_in)
                ->orderBy('hk.check_out', 'asc');

        }

        // Hanya Check Out
        elseif ($request->filled('cari_check_out')) {

            $query->whereDate('hk.check_out', $cari_check_out)
                ->orderBy('hk.check_in', 'asc');

        }

        // Tanpa Filter Tanggal
        else {

            $query->orderByDesc('hk.check_in')
                ->orderByDesc('hk.check_out');

        }

        $histori = $query->get();

        /*
        |--------------------------------------------------------------------------
        | STATUS BOOKING / CHECK IN
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        foreach ($histori as $row) {

            if ($today < Carbon::parse($row->check_in)) {

                $row->status = 'booking';

            } else {

                $row->status = 'check_in';

            }

        }

        /*
        |--------------------------------------------------------------------------
        | FILTER STATUS
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $histori = $histori->filter(function ($item) use ($status) {
                return $item->status == $status;
            });

        }

        return view('InformasiPemesanan', compact('histori'));
    }







    // Modal Buat Resi Manual
    public function BuatResiManual(Request $request)
    {
        return view('BuatResiManual');
    }






    public function store_BuatResiManual(Request $request)
    {
        DB::beginTransaction();

        try {

            DB::table('resi_manual')->insert([

                'nama_tamu_resi_manual' => $request->nama_tamu_resi_manual,
                'alamat_tamu_resi_manual' => $request->alamat_tamu_resi_manual,

                'check_in' => $request->check_in_resi_manual,
                'check_out' => $request->check_out_resi_manual,

                'jumlah_kamar_deluxe' => $request->jumlah_kamar_deluxe,
                'jumlah_kamar_superior' => $request->jumlah_kamar_superior,
                'jumlah_kamar_standart' => $request->jumlah_kamar_standart,
                'jumlah_homestay' => $request->jumlah_homestay,

                'jumlah_ekstrabed' => $request->jumlah_ekstrabed,
                'jumlah_breakfast' => $request->jumlah_breakfast,

            ]);

            DB::commit();

            NotifikasiService::buat(
                'Resi Manual Dibuat',
                'Resi manual atas nama "' . $request->nama_tamu_resi_manual . '" berhasil dibuat.',
                'resi_manual',
                $request->dibuat_oleh
            );

            return response()->json([
                'success' => true,
                'message' => 'Data resi manual berhasil disimpan.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }








    public function LihatResiManual(Request $request)
    {
        $data = DB::table('resi_manual')->first();

        return view('LihatResiManual', compact('data'));
    }





    public function KosongkanResiManual(Request $request)
    {
        DB::beginTransaction();

        try {

            DB::table('resi_manual')->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Resi Manual berhasil dikosongkan.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }









    public function ModalInfo(Request $request)
    {
        $id = $request->id_rincian_pesanan;

        /*
        |--------------------------------------------------------------------------
        | DATA HEADER
        |--------------------------------------------------------------------------
        */

        $data = DB::table('rincian_pesanan')
            ->where('id_rincian_pesanan', $id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | HISTORI (ambil satu data untuk informasi umum)
        |--------------------------------------------------------------------------
        */

        $histori = DB::table('histori_kamar')
            ->where('id_rincian_pesanan', $id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | REQUEST TAMBAHAN
        |--------------------------------------------------------------------------
        */

        $requestTambahan = DB::table('request as r')
            ->join('kamar as k', 'r.kode_request', '=', 'k.kode_kamar')
            ->select(
                'k.tipe_kamar',
                'r.jumlah_request',
                'r.total_harga'
            )
            ->where('r.id_rincian_pesanan', $id)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | DAFTAR KAMAR
        |--------------------------------------------------------------------------
        */

        $kamar = DB::table('histori_kamar as hk')
            ->join(
                'nomor_kamar as nk',
                'hk.id_nomor_kamar',
                '=',
                'nk.id_nomor_kamar'
            )
            ->join(
                'kamar as k',
                'nk.id_kamar',
                '=',
                'k.id_kamar'
            )
            ->select(
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.id_kamar',
                'k.tipe_kamar'
            )
            ->where(
                'hk.id_rincian_pesanan',
                $id
            )
            ->orderBy('k.id_kamar')
            ->orderBy('nk.nomor_kamar')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | FOTO KTP
        |--------------------------------------------------------------------------
        */

        $foto = DB::table('laporan_keuangan')
            ->where('id_rincian_pesanan', $id)
            ->whereNotNull('foto_ktp')
            ->first();

        return view('ModalInfo', [
            'data' => $data,
            'histori' => $histori,
            'foto' => $foto,
            'kamar' => $kamar,
            'requestTambahan' => $requestTambahan
        ]);
    }










    public function UploadFotoKTP(Request $request)
    {
        try {

            $foto = null;

            if ($request->hasFile('foto_ktp')) {

                $namaTamu = DB::table('rincian_pesanan')
                    ->where('id_rincian_pesanan', $request->id_rincian_pesanan)
                    ->value('nama_tamu');

                $timestamp = now()->format('Y-m-d_H-i-s');

                $nama = str_replace(' ', '_', $namaTamu);

                $foto = "Foto_KTP_" .
                    $nama .
                    "_" .
                    $timestamp .
                    "." .
                    $request->file('foto_ktp')->extension();

                $storagePath = 'public/uploads/foto_ktp/';

                $request->file('foto_ktp')->storeAs(
                    $storagePath,
                    $foto
                );

                $publicPath = public_path(
                    'storage/uploads/foto_ktp/'
                );

                if (!is_dir($publicPath)) {

                    mkdir($publicPath, 0777, true);

                }

                copy(
                    storage_path(
                        'app/' .
                        $storagePath .
                        $foto
                    ),
                    public_path(
                        'storage/uploads/foto_ktp/' .
                        $foto
                    )
                );
            }

            DB::table('laporan_keuangan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->update([
                    'foto_ktp' => $foto
                ]);

            return response()->json([
                'success' => true
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);

        }
    }








    public function ModalResi(Request $request)
    {
        $id = $request->id_rincian_pesanan;

        // Data transaksi
        $data = DB::table('rincian_pesanan')
            ->where('id_rincian_pesanan', $id)
            ->first();

        // Ambil data tamu (alamat di histori)
        $histori = DB::table('histori_kamar')
            ->where('id_rincian_pesanan', $id)
            ->first();

        // Lama menginap
        $lama = Carbon::parse($histori->check_out)->diffInDays(Carbon::parse($histori->check_in));

        // Ambil seluruh kamar yang dipesan
        $kamar = DB::table('histori_kamar as hk')

            ->join(
                'nomor_kamar as nk',
                'hk.id_nomor_kamar',
                '=',
                'nk.id_nomor_kamar'
            )

            ->join(
                'kamar as k',
                'nk.id_kamar',
                '=',
                'k.id_kamar'
            )

            ->where(
                'hk.id_rincian_pesanan',
                $id
            )

            ->select(
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'k.tipe_kamar',
                'k.tarif_per_hari'
            )

            ->get();


        $detailKamar = [];

        foreach ($kamar as $item) {
            if (!isset($detailKamar[$item->kode_kamar])) {
                $detailKamar[$item->kode_kamar] = [
                    'nama' => $item->tipe_kamar,
                    'jumlah' => 0,
                    'tarif' => $item->tarif_per_hari,
                    'subtotal' => 0,
                    'nomor_kamar' => []
                ];
            }

            $detailKamar[$item->kode_kamar]['jumlah']++;

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

            ->join(
                'kamar as k',
                'r.kode_request',
                '=',
                'k.kode_kamar'
            )

            ->where(
                'r.id_rincian_pesanan',
                $id
            )

            ->select(
                'r.kode_request',
                'r.jumlah_request',
                'r.total_harga',
                'k.tipe_kamar',
                'k.tarif_per_hari'
            )

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










    protected $whatsappService;
    public function __construct(WhatsAppService $whatsappService)
    {
        $this->whatsappService = $whatsappService;
    }











    public function kirimResiWA($id)
    {

        $target = '6288975660188';

        $message = 'Halo, ini adalah percobaan pertama pengiriman WhatsApp dari Aplikasi Hotel Nirwana.';

        $response = $this->whatsappService->sendText($target, $message);

        return response()->json($response->json());

    }











    public function uploadResiWA(Request $request, $id)
    {
        $request->validate([
            'image' => 'required'
        ]);

        // Ambil data reservasi
        $rincian = DB::table('rincian_pesanan')
            ->where('id_rincian_pesanan', $id)
            ->first();

        if (!$rincian) {
            return response()->json([
                'success' => false,
                'message' => 'Data reservasi tidak ditemukan.'
            ], 404);
        }

        // Ambil nama tamu
        $namaTamu = trim($rincian->nama_tamu);

        // Bersihkan nama file
        $namaFile = preg_replace('/[^A-Za-z0-9\s]/', '', $namaTamu);
        $namaFile = str_replace(' ', '_', $namaFile);

        // Ambil gambar Base64
        $image = $request->image;
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        // Nama file
        $timestamp = now()->format('Y-m-d_H-i-s');

        $fileName = "Resi_Hotel_{$namaFile}_{$timestamp}.jpg";

        // Folder Storage
        $storagePath = 'public/uploads/resi/';

        // Simpan ke Storage
        Storage::put(
            $storagePath . $fileName,
            base64_decode($image)
        );

        // Folder Public
        $publicPath = public_path('storage/uploads/resi/');

        if (!is_dir($publicPath)) {
            mkdir($publicPath, 0777, true);
        }

        // Copy ke Public
        copy(
            storage_path('app/' . $storagePath . $fileName),
            public_path('storage/uploads/resi/' . $fileName)
        );



        // Ambil nomor WhatsApp tamu
        $target = $rincian->no_wa_tamu;

        // URL gambar yang bisa diakses Fonnte
        $urlGambar = url('storage/uploads/resi/' . $fileName);

        // Pesan WhatsApp
        $pesan =
            "🏨 *NIRWANA HOTEL KALIANDA*\n\n"

            . "Halo *{$rincian->nama_tamu}*,\n\n"

            . "Terima kasih telah memilih *Nirwana Hotel Kalianda* sebagai tempat menginap Anda.\n\n"

            . "Berikut kami kirimkan *Resi Pembayaran* dalam bentuk gambar yang dapat dibuka melalui tautan berikut:\n\n"

            . $urlGambar . "\n\n"

            . "Silakan simpan resi tersebut sebagai bukti pembayaran.\n\n"

            . "Apabila terdapat pertanyaan atau membutuhkan bantuan, silakan hubungi resepsionis kami.\n\n"

            . "Terima kasih.\n\n"

            . "*NIRWANA HOTEL KALIANDA*";

        // Kirim gambar
        $response = $this->whatsappService->sendImage(
            $target,
            $pesan,
            $urlGambar
        );
        $result = $response->json();

        if (
            isset($result['detail']) &&
            str_contains(strtolower($result['detail']), 'success')
        ) {

            return response()->json([
                'success' => true,
                'message' => 'Resi berhasil dikirim ke WhatsApp.',
                'url_resi' => $urlGambar,
                'nama_file' => $fileName
            ]);

        }

        return response()->json([
            'success' => false,
            'message' => 'Resi gagal dikirim.',
            'response' => $result
        ], 500);
    }








    // Modal Pembayaran
    public function ModalPembayaran(Request $request)
    {
        $id_rincian_pesanan = $request->id_rincian_pesanan;
        return view('ModalPembayaran', compact('id_rincian_pesanan'));
    }






    public function store_ModalPembayaran(Request $request)
    {
        try {
            $dataPesanan = DB::table('rincian_pesanan')
                ->select('nama_tamu')
                ->where('id_rincian_pesanan', $request->id_rincian_pesanan)
                ->first();

            $nama = 'Tanpa_Nama';

            if ($dataPesanan) {
                $nama = str_replace(' ', '_', $dataPesanan->nama_tamu);
            }

            /* ===============================
               UPLOAD BUKTI PEMBAYARAN
            ================================*/
            $bukti_pembayaran = null;


            if ($request->hasFile('bukti_pembayaran')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
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
            // TENTUKAN METODE PEMBAYARAN
            // ==========================

            if ($request->metode_pembayaran == 'online') {

                $metodePembayaran = $request->sumber_pembayaran;

            } elseif ($request->metode_pembayaran == 'cash') {

                $metodePembayaran = 'Cash';

            } else {

                $metodePembayaran = null;

            }

            // ==========================
            // UPDATE PEMBAYARAN
            // ==========================
            DB::table('laporan_keuangan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->update([
                    'status_pembayaran' => 1,
                    'metode_pembayaran' => $metodePembayaran,
                    'bukti_pembayaran' => $bukti_pembayaran
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
            ->where('id_rincian_pesanan', $id)
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
            ->where('id_rincian_pesanan', $id)
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







    public function LihatBukti(Request $request)
    {
        $bukti = DB::table('laporan_keuangan')
            ->where('id_rincian_pesanan', $request->id_rincian_pesanan)
            ->first();

        return view('LihatBukti', compact('bukti'));
    }










    // Modal Edit Pesan Kamar
    public function ModalEdit(Request $request)
    {
        $id = $request->id_rincian_pesanan;

        $histori_kamar = DB::table('histori_kamar')
            ->where('id_rincian_pesanan', $id)
            ->first();

        $rincian_pesanan = DB::table('rincian_pesanan')
            ->where('id_rincian_pesanan', $id)
            ->first();

        return view('ModalEdit', [
            'id_rincian_pesanan' => $id,
            'histori_kamar' => $histori_kamar,
            'rincian_pesanan' => $rincian_pesanan
        ]);
    }










    public function store_ModalEdit(Request $request)
    {
        DB::beginTransaction();

        try {
            // =====================================
            // UBAH VALUE HOME STAY MENJADI 2 KAMAR
            // =====================================
            $idNomorKamar = [];

            foreach ($request->id_nomor_kamar as $item) {

                if ($item == 'HMSTY') {

                    $homeStay = DB::table('nomor_kamar as nk')
                        ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
                        ->where('k.kode_kamar', 'HMSTY')
                        ->pluck('nk.id_nomor_kamar')
                        ->toArray();

                    $idNomorKamar = array_merge($idNomorKamar, $homeStay);

                } else {

                    $idNomorKamar[] = $item;

                }
            }

            $request->merge([
                'id_nomor_kamar' => $idNomorKamar
            ]);




            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA LAMA
            |--------------------------------------------------------------------------
            */

            $laporanLama = DB::table('laporan_keuangan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->first();

            if (!$laporanLama) {
                throw new \Exception('Data pesanan tidak ditemukan.');
            }

            $historiLama = DB::table('histori_kamar')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->first();

            if (!$historiLama) {
                throw new \Exception('Data histori kamar tidak ditemukan.');
            }


            $rincianLama = DB::table('rincian_pesanan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->first();

            if (!$rincianLama) {
                throw new \Exception('Data rincian pesanan tidak ditemukan.');
            }


            /*
            |--------------------------------------------------------------------------
            | SIMPAN DATA YANG TIDAK BOLEH HILANG
            |--------------------------------------------------------------------------
            */
            $nama_tamu = $request->edit_nama_tamu;
            $alamat_tamu = $request->edit_alamat_tamu;
            $no_wa_tamu = $request->edit_no_wa_tamu;

            $statusPembayaranLama = $laporanLama->status_pembayaran ?? 0;
            $metodePembayaranLama = $laporanLama->metode_pembayaran ?? null;
            $buktiPembayaranLama = $laporanLama->bukti_pembayaran ?? null;
            $fotoKtpLama = $laporanLama->foto_ktp ?? null;



            /*
            |--------------------------------------------------------------------------
            | HAPUS REQUEST TAMBAHAN
            |--------------------------------------------------------------------------
            */
            DB::table('request')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS HISTORI KAMAR
            |--------------------------------------------------------------------------
            */
            DB::table('histori_kamar')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->delete();

            /*
            |--------------------------------------------------------------------------
            | HAPUS LAPORAN KEUANGAN
            |--------------------------------------------------------------------------
            */
            DB::table('laporan_keuangan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->delete();

            /*
            |--------------------------------------------------------------------------
            | AMBIL DATA KAMAR BARU
            |--------------------------------------------------------------------------
            */
            $kamarDipilih = DB::table('nomor_kamar as nk')
                ->join(
                    'kamar as k',
                    'nk.id_kamar',
                    '=',
                    'k.id_kamar'
                )
                ->whereIn(
                    'nk.id_nomor_kamar',
                    $request->id_nomor_kamar
                )
                ->get();
            if ($kamarDipilih->count() == 0) {
                throw new \Exception('Data kamar tidak ditemukan.');
            }
            $groupKamar = $kamarDipilih->groupBy('id_kamar');


            /*
            |--------------------------------------------------------------------------
            | LAMA INAP
            |--------------------------------------------------------------------------
            */
            $checkIn = \Carbon\Carbon::parse($request->edit_check_in);
            $checkOut = \Carbon\Carbon::parse($request->edit_check_out);
            $lama_inap = $checkOut->diffInDays($checkIn);
            if ($lama_inap <= 0) {
                throw new Exception('Tanggal check out harus setelah check in.');
            }


            /*
            |--------------------------------------------------------------------------
            | JUMLAH KAMAR
            |--------------------------------------------------------------------------
            */
            $jumlah_kamar = count($request->id_nomor_kamar);


            /*
            |--------------------------------------------------------------------------
            | HITUNG BIAYA REQUEST
            |--------------------------------------------------------------------------
            */
            $extraBed = DB::table('kamar')
                ->where('kode_kamar', 'BED')
                ->first();

            $breakfast = DB::table('kamar')
                ->where('kode_kamar', 'FAST')
                ->first();

            $jumlahExtraBed = (int) $request->edit_jumlah_extra_bed;
            $jumlahBreakfast = (int) $request->edit_jumlah_breakfast;
            $totalExtraBed =
                $jumlahExtraBed *
                ($extraBed->tarif_per_hari ?? 0);

            $totalBreakfast =
                $jumlahBreakfast *
                ($breakfast->tarif_per_hari ?? 0);

            $biaya_tambahan =
                $totalExtraBed +
                $totalBreakfast;





            /*
            |--------------------------------------------------------------------------
            | HITUNG TOTAL BIAYA KAMAR
            |--------------------------------------------------------------------------
            */
            $biaya = 0;
            foreach ($groupKamar as $idKamar => $rooms) {
                $tarif = $rooms->first()->after_10_persen;
                $biaya +=
                    count($rooms) *
                    $tarif *
                    $lama_inap;
            }

            $pajak = $biaya * 0.19;
            $total_diterima =
                ($biaya - $pajak) +
                $biaya_tambahan;



            /*
            |--------------------------------------------------------------------------
            | UPLOAD FOTO KTP (JIKA DIGANTI)
            |--------------------------------------------------------------------------
            */
            if ($request->hasFile('edit_foto_ktp')) {
                $timestamp = now()->format('Y-m-d_H-i-s');
                $nama = str_replace(' ', '_', $nama_tamu);
                $foto_ktp = "Foto_KTP_" . $nama . "_" . $timestamp . "." . $request->file('edit_foto_ktp')->extension();
                $storagePath = 'public/uploads/foto_ktp/';
                $request->file('edit_foto_ktp')->storeAs($storagePath, $foto_ktp);
                $publicPath = public_path('storage/uploads/foto_ktp/');
                if (!is_dir($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $sourceFile = storage_path('app/' . $storagePath . $foto_ktp);
                $destinationFile = public_path('storage/uploads/foto_ktp/' . $foto_ktp);
                copy($sourceFile, $destinationFile);
            } else {
                $foto_ktp = $fotoKtpLama;
            }




            /*
            |--------------------------------------------------------------------------
            | UPDATE RINCIAN PESANAN
            |--------------------------------------------------------------------------
            */
            DB::table('rincian_pesanan')
                ->where(
                    'id_rincian_pesanan',
                    $request->id_rincian_pesanan
                )
                ->update([
                    'nama_tamu' => $nama_tamu,
                    'no_wa_tamu' => $no_wa_tamu,
                    'total_kamar_dipesan' => $jumlah_kamar,
                    'total_request' => $biaya_tambahan
                ]);






            // =====================================
            // INSERT LAPORAN KEUANGAN
            // SATU DATA PER TIPE KAMAR
            // =====================================
            $idLaporanPerKamar = [];
            foreach ($groupKamar as $idKamar => $items) {
                $kamar = $items->first();
                $jumlahPerTipe = $items->count();
                $biaya =
                    $jumlahPerTipe *
                    $kamar->after_10_persen *
                    $lama_inap;

                $pajak = $biaya * 0.19;
                $total_diterima =
                    ($biaya - $pajak);

                $idLaporan =
                    DB::table('laporan_keuangan')
                        ->insertGetId([
                            'id_rincian_pesanan' => $request->id_rincian_pesanan,
                            'kode_kamar' => $kamar->kode_kamar,
                            'nama_tamu' => $nama_tamu,
                            'tipe_kamar' => $kamar->tipe_kamar,
                            'jumlah_kamar_dipesan' => $jumlahPerTipe,
                            'tarif_per_hari' => $kamar->tarif_per_hari,
                            'before_10_persen' => $kamar->before_10_persen,
                            'after_10_persen' => $kamar->after_10_persen,
                            'tanggal_dipesan' => now(),
                            'check_in' => $request->edit_check_in,
                            'check_out' => $request->edit_check_out,
                            'lama_inap' => $lama_inap,
                            'biaya' => $biaya,

                            // request sekarang disimpan
                            // di tabel request
                            'biaya_tambahan' => 0,
                            'pajak' => $pajak,
                            'total_diterima' => $total_diterima,
                            'foto_ktp' => $foto_ktp,
                            'metode_pembayaran' => $metodePembayaranLama,
                            'bukti_pembayaran' => $buktiPembayaranLama,
                            'status_pembayaran' => $statusPembayaranLama
                        ]);

                // Simpan relasi nomor kamar -> id laporan
                foreach ($items as $item) {
                    $idLaporanPerKamar[$item->id_nomor_kamar] = $idLaporan;
                }
            }



            /*
            |--------------------------------------------------------------------------
            | INSERT HISTORI KAMAR
            |--------------------------------------------------------------------------
            */
            foreach ($request->id_nomor_kamar as $idNomorKamar) {
                DB::table('histori_kamar')->insert([
                    'id_rincian_pesanan' => $request->id_rincian_pesanan,
                    'id_laporan_keuangan' => $idLaporanPerKamar[$idNomorKamar],
                    'id_nomor_kamar' => $idNomorKamar,
                    'nama_tamu' => $nama_tamu,
                    'alamat_tamu' => $alamat_tamu,
                    'check_in' => $request->edit_check_in,
                    'check_out' => $request->edit_check_out
                ]);
            }






            /*
            |--------------------------------------------------------------------------
            | INSERT REQUEST
            |--------------------------------------------------------------------------
            */

            if ($jumlahExtraBed > 0) {
                DB::table('request')->insert([
                    'id_rincian_pesanan' => $request->id_rincian_pesanan,
                    'kode_request' => 'BED',
                    'jumlah_request' => $jumlahExtraBed,
                    'total_harga' => $totalExtraBed
                ]);
            }

            if ($jumlahBreakfast > 0) {
                DB::table('request')->insert([
                    'id_rincian_pesanan' => $request->id_rincian_pesanan,
                    'kode_request' => 'FAST',
                    'jumlah_request' => $jumlahBreakfast,
                    'total_harga' => $totalBreakfast
                ]);
            }


            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }







    public function HapusPesanan(Request $request, $id)
    {
        DB::beginTransaction();

        try {


            $data = DB::table('laporan_keuangan')
                ->where('id_rincian_pesanan', $id)
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

            if (!empty($data->foto_ktp)) {

                // Hapus dari storage/app/public
                Storage::delete(
                    'public/uploads/foto_ktp/' .
                    $data->foto_ktp
                );

                // Hapus dari public/storage
                $filePublic = public_path(
                    'storage/uploads/foto_ktp/' .
                    $data->foto_ktp
                );

                if (file_exists($filePublic)) {
                    unlink($filePublic);
                }
            }

            /*
            |--------------------------------------------------------------------------
            | HAPUS REQUEST TAMBAHAN
            |--------------------------------------------------------------------------
            */
            DB::table('request')
                ->where(
                    'id_rincian_pesanan',
                    $id
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS HISTORI KAMAR
            |--------------------------------------------------------------------------
            */
            DB::table('histori_kamar')
                ->where(
                    'id_rincian_pesanan',
                    $id
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS LAPORAN KEUANGAN
            |--------------------------------------------------------------------------
            */
            DB::table('laporan_keuangan')
                ->where(
                    'id_rincian_pesanan',
                    $id
                )
                ->delete();


            /*
            |--------------------------------------------------------------------------
            | HAPUS RINCIAN PESANAN
            |--------------------------------------------------------------------------
            */
            DB::table('rincian_pesanan')
                ->where(
                    'id_rincian_pesanan',
                    $id
                )
                ->delete();


            DB::commit();

            return redirect()
                ->back()
                ->with('success', 'Pesanan berhasil dibatalkan.');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }











    public function DataMaster(Request $request)
    {
        $kamar = DB::table('kamar')
            ->pluck('tarif_per_hari', 'kode_kamar')
            ->toArray();


        $tarifKamar = Kamar::select('kode_kamar', 'tarif_per_hari')
            ->get()
            ->keyBy('kode_kamar');



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





        $HomeStay = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->leftJoin('histori_kamar as hk', function ($join) use ($tanggalHariIni) {
                $join->on('nk.id_nomor_kamar', '=', 'hk.id_nomor_kamar')
                    ->whereDate('hk.check_in', '<=', $tanggalHariIni)
                    ->whereDate('hk.check_out', '>', $tanggalHariIni);
            })
            ->where('k.kode_kamar', 'HMSTY')
            ->select(
                'nk.id_nomor_kamar',
                'nk.nomor_kamar',
                'nk.jenis_bed',
                'k.kode_kamar',
                'hk.id_histori_kamar as histori_aktif' // ✅ PENANDA TERISI ATAU TIDAK
            )
            ->get();
        $HomeStayTersedia = $HomeStay->whereNull('histori_aktif')->count();
        $SingleHMSTY = $HomeStay
            ->whereNull('histori_aktif')
            ->where('jenis_bed', 1)
            ->count();

        $DoubleHMSTY = $HomeStay
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

        return view('DataMaster', compact('kamar', 'kamarDLX', 'kamarSingleDLX', 'kamarDoubleDLX', 'HomeStay', 'SingleHMSTY', 'DoubleHMSTY', 'kamarSPR', 'kamarSingleSPR', 'kamarDoubleSPR', 'kamarSTD', 'kamarSingleSTD', 'kamarDoubleSTD', 'tarifKamar'));
    }







    // Modal Tambah Kamar Deluxe
    public function TambahKamarDeluxe(Request $request)
    {
        $kode_kamar = $request->kode_kamar;
        return view('TambahModalDLX', compact('kode_kamar'));
    }







    public function store_TambahModalDLX(Request $request)
    {
        DB::beginTransaction();

        try {

            // Mapping kode kamar ke id_kamar
            $mappingKamar = [
                'DLX' => 1,
                'SPR' => 2,
                'STD' => 3,
                'HMSTY' => 4,
            ];

            // Cek apakah kode kamar valid
            if (!isset($mappingKamar[$request->kode_kamar])) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Kode kamar tidak valid.'
                ], 422);

            }

            $id_kamar = $mappingKamar[$request->kode_kamar];

            /*
            |--------------------------------------------------------------------------
            | AMBIL NOMOR KAMAR TERAKHIR BERDASARKAN TIPE KAMAR
            |--------------------------------------------------------------------------
            */

            $nomorTerakhir = DB::table('nomor_kamar')
                ->where('id_kamar', $id_kamar)
                ->max('nomor_kamar');

            // Jika belum ada kamar sama sekali
            $nomorTerakhir = $nomorTerakhir ? (int) $nomorTerakhir : 0;

            /*
            |--------------------------------------------------------------------------
            | INSERT KAMAR BARU
            |--------------------------------------------------------------------------
            */

            for ($i = 1; $i <= $request->jumlah_kamar; $i++) {

                $nomorTerakhir++;

                DB::table('nomor_kamar')->insert([
                    'id_kamar' => $id_kamar,
                    'nomor_kamar' => $nomorTerakhir,
                    'jenis_bed' => $request->jenis_bed
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







    // Modal Edit Harga Deluxe
    public function EditHargaDeluxe(Request $request)
    {
        $kode_kamar = $request->kode_kamar;
        $kamar = DB::table('kamar')
            ->pluck('tarif_per_hari', 'kode_kamar')
            ->toArray();
        return view('EditHargaDeluxe', compact('kode_kamar', 'kamar'));
    }






    public function store_EditHargaDeluxe(Request $request)
    {
        DB::beginTransaction();

        try {

            // Bersihkan format rupiah
            $tarif_per_hari = preg_replace('/[^0-9]/', '', $request->harga_dlx);

            if (empty($tarif_per_hari) || $tarif_per_hari <= 0) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Harga kamar tidak valid.'
                ], 422);

            }

            DB::table('kamar')
                ->where('kode_kamar', $request->kode_kamar)
                ->update([
                    'tarif_per_hari' => $tarif_per_hari
                ]);

            DB::commit();

            return response()->json([
                'status' => 'success'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }
    }






    // Modal Hapus Kamar Deluxe
    public function HapusKamarDeluxe(Request $request)
    {
        $kode_kamar = $request->kode_kamar;

        $jumlahKamar = DB::table('nomor_kamar as nk')
            ->join('kamar as k', 'nk.id_kamar', '=', 'k.id_kamar')
            ->where('k.kode_kamar', $kode_kamar)
            ->count();

        return view('HapusKamarDeluxe', compact(
            'kode_kamar',
            'jumlahKamar'
        ));
    }





    public function store_HapusKamarDeluxe(Request $request)
    {
        DB::beginTransaction();

        try {

            // Mapping kode kamar
            $mappingKamar = [
                'DLX' => 1,
                'SPR' => 2,
                'STD' => 3,
                'HMSTY' => 4,
            ];

            if (!isset($mappingKamar[$request->kode_kamar])) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Kode kamar tidak valid.'
                ], 422);

            }

            $idKamar = $mappingKamar[$request->kode_kamar];

            $hariIni = date('Y-m-d');

            // Ambil kamar kosong dengan nomor terbesar
            $kamarKosong = DB::table('nomor_kamar as nk')

                ->where('nk.id_kamar', $idKamar)

                ->whereNotIn('nk.id_nomor_kamar', function ($q) use ($hariIni) {

                    $q->select('id_nomor_kamar')
                        ->from('histori_kamar')

                        ->whereDate('check_in', '<=', $hariIni)
                        ->whereDate('check_out', '>', $hariIni);

                })

                ->orderByDesc('nk.nomor_kamar')

                ->limit($request->jumlah_kamar)

                ->get();

            // Jika kamar kosong kurang dari yang diminta
            if ($kamarKosong->count() < $request->jumlah_kamar) {

                DB::rollBack();

                return response()->json([
                    'status' => 'error',
                    'message' => 'Tidak dapat menghapus kamar karena sebagian kamar masih digunakan.'
                ], 422);

            }

            // Hapus kamar
            DB::table('nomor_kamar')
                ->whereIn(
                    'id_nomor_kamar',
                    $kamarKosong->pluck('id_nomor_kamar')
                )
                ->delete();

            DB::commit();

            return response()->json([
                'status' => 'success'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);

        }
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