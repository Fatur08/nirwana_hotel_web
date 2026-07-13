<?php

namespace App\Services\Resi;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\WhatsApp\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ResiService
{
    protected WhatsAppService $whatsappService;

    public function __construct(
        WhatsAppService $whatsappService
    ) {
        $this->whatsappService = $whatsappService;
    }









    /**
     * Mengambil seluruh data pesanan
     */
    public function getDataPesanan($idRincianPesanan)
    {
        return DB::table('rincian_pesanan as rp')

            ->leftJoin(
                'laporan_keuangan as lk',
                'rp.id_rincian_pesanan',
                '=',
                'lk.id_rincian_pesanan'
            )

            ->select(
                'rp.*',
                'lk.*'
            )

            ->where(
                'rp.id_rincian_pesanan',
                $idRincianPesanan
            )

            ->first();
    }









    /**
     * Membuat nama file resi
     */
    public function getNamaFile($dataPesanan)
    {
        // Bersihkan nama tamu agar aman dijadikan nama file
        $namaTamu = preg_replace(
            '/[^A-Za-z0-9]/',
            '_',
            trim($dataPesanan->nama_tamu)
        );

        // Ambil tanggal check in
        $tanggalCheckIn = date(
            'Y-m-d',
            strtotime($dataPesanan->check_in)
        );

        return "Resi_Hotel_{$namaTamu}_{$tanggalCheckIn}.jpg";
    }










    /**
     * Menghasilkan lokasi penyimpanan resi di Storage
     */
    public function getStoragePath($dataPesanan)
    {
        return storage_path(
            'app/public/uploads/resi/' .
            $this->getNamaFile($dataPesanan)
        );
    }







    /**
     * Menghasilkan lokasi penyimpanan resi di Public
     */
    public function getPublicPath($dataPesanan)
    {
        return public_path(
            'storage/uploads/resi/' .
            $this->getNamaFile($dataPesanan)
        );
    }









    /**
     * Menghasilkan URL resi yang dapat diakses melalui browser
     */
    public function getUrl($dataPesanan, $absolute = true)
    {
        $path = 'storage/uploads/resi/' .
            $this->getNamaFile($dataPesanan);

        return $absolute
            ? asset($path)
            : $path;
    }








    /**
     * Mengecek apakah file resi tersedia
     */
    public function exists($dataPesanan)
    {
        return file_exists($this->getStoragePath($dataPesanan))
            && file_exists($this->getPublicPath($dataPesanan));
    }












    /**
     * Menghapus file resi
     */
    public function delete($dataPesanan)
    {
        $storagePath = $this->getStoragePath($dataPesanan);
        $publicPath = $this->getPublicPath($dataPesanan);
        /*
        |--------------------------------------------------------------------------
        | Hapus file di Storage
        |--------------------------------------------------------------------------
        */
        if (file_exists($storagePath)) {
            unlink($storagePath);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus file di Public
        |--------------------------------------------------------------------------
        */
        if (file_exists($publicPath)) {
            unlink($publicPath);
        }

        return true;
    }










    /**
     * Generate resi hotel
     */
    public function generate($idRincianPesanan)
    {
        $dataPesanan = $this->getDataPesanan($idRincianPesanan);

        if (!$dataPesanan) {
            throw new \Exception('Data pesanan tidak ditemukan.');
        }

        if ($this->exists($dataPesanan)) {
            $this->delete($dataPesanan);
        }

        return $dataPesanan;
    }













    /**
     * Menyimpan gambar resi ke Storage dan Public
     */
    public function saveImage($base64Image, $dataPesanan)
    {
        /*
        |--------------------------------------------------------------------------
        | Bersihkan Format Base64
        |--------------------------------------------------------------------------
        */
        $image = str_replace(
            'data:image/jpeg;base64,',
            '',
            $base64Image
        );

        $image = str_replace(
            ' ',
            '+',
            $image
        );

        /*
        |--------------------------------------------------------------------------
        | Nama File
        |--------------------------------------------------------------------------
        */
        $fileName = $this->getNamaFile($dataPesanan);

        /*
        |--------------------------------------------------------------------------
        | Folder Storage
        |--------------------------------------------------------------------------
        */
        $storageFolder = 'public/uploads/resi/';

        /*
        |--------------------------------------------------------------------------
        | Simpan ke Storage
        |--------------------------------------------------------------------------
        */
        Storage::put(

            $storageFolder . $fileName,

            base64_decode($image)

        );

        /*
        |--------------------------------------------------------------------------
        | Folder Public
        |--------------------------------------------------------------------------
        */
        $publicFolder = public_path(
            'storage/uploads/resi/'
        );

        if (!is_dir($publicFolder)) {

            mkdir(
                $publicFolder,
                0777,
                true
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Copy Storage -> Public
        |--------------------------------------------------------------------------
        */
        copy(

            $this->getStoragePath($dataPesanan),

            $this->getPublicPath($dataPesanan)

        );

        /*
        |--------------------------------------------------------------------------
        | Return Informasi File
        |--------------------------------------------------------------------------
        */
        return [

            'nama_file' => $fileName,

            'storage_path' => $this->getStoragePath($dataPesanan),

            'public_path' => $this->getPublicPath($dataPesanan),

            'url' => $this->getUrl($dataPesanan),

        ];
    }













    /**
     * Membuat isi pesan WhatsApp
     */
    public function buildMessage($dataPesanan, $urlResi)
    {
        /*
        |--------------------------------------------------------------------------
        | Format Tanggal Indonesia
        |--------------------------------------------------------------------------
        */

        Carbon::setLocale('id');

        $checkIn = Carbon::parse(
            $dataPesanan->check_in
        )->translatedFormat('l, d F Y');

        $checkOut = Carbon::parse(
            $dataPesanan->check_out
        )->translatedFormat('l, d F Y');
        return
            "🏨 *NIRWANA HOTEL KALIANDA*\n\n"
            . "Halo *{$dataPesanan->nama_tamu}*,\n\n"
            . "Terima kasih telah memilih *Nirwana Hotel Kalianda* sebagai tempat menginap Anda.\n\n"
            . "Berikut kami kirimkan *Resi Pembayaran* dalam bentuk gambar yang dapat dibuka melalui tautan berikut:\n\n"
            . $urlResi . "\n\n"
            . "Silakan simpan resi tersebut sebagai bukti pembayaran.\n\n"
            . "Check In*  : {$checkIn}\n"
            . "Check Out* : {$checkIn}\n\n"
            . "Apabila terdapat pertanyaan atau membutuhkan bantuan, silakan hubungi resepsionis kami.\n\n"
            . "Terima kasih atas kepercayaan Anda.\n\n"
            . "*NIRWANA HOTEL KALIANDA*";
    }










    /**
     * Generate resi kemudian kirim ke WhatsApp
     */
    public function kirimWhatsApp($idRincianPesanan, $base64Image)
    {
        /*
        |--------------------------------------------------------------------------
        | Generate Data Resi
        |--------------------------------------------------------------------------
        */
        $dataPesanan = $this->generate(
            $idRincianPesanan
        );

        /*
        |--------------------------------------------------------------------------
        | Simpan Gambar Resi
        |--------------------------------------------------------------------------
        */
        $hasilResi = $this->saveImage(
            $base64Image,
            $dataPesanan
        );

        /*
        |--------------------------------------------------------------------------
        | Membuat Pesan WhatsApp
        |--------------------------------------------------------------------------
        */
        $pesan = $this->buildMessage(
            $dataPesanan,
            $hasilResi['url']
        );

        /*
        |--------------------------------------------------------------------------
        | Kirim Gambar ke WhatsApp
        |--------------------------------------------------------------------------
        */
        $response = $this->whatsappService->sendImage(

            $dataPesanan->no_wa_tamu,

            $pesan,

            $hasilResi['url']

        );

        $result = $response->json();
        /*
|--------------------------------------------------------------------------
| Laravel Log
|--------------------------------------------------------------------------
*/

        Log::info(

            "\n"

            . "====================================================\n"

            . "            WHATSAPP RESI HOTEL\n"

            . "====================================================\n"

            . "Tanggal      : " . now()->format('d-m-Y H:i:s') . "\n"

            . "Nama Tamu    : {$dataPesanan->nama_tamu}\n"

            . "Nomor WA     : {$dataPesanan->no_wa_tamu}\n"

            . "Nama File    : {$hasilResi['nama_file']}\n"

            . "URL Resi     : {$hasilResi['url']}\n"

            . "Status       : "
            . (
                isset($result['detail']) &&
                str_contains(
                    strtolower($result['detail']),
                    'success'
                )
                ? 'BERHASIL'
                : 'GAGAL'
            )
            . "\n"

            . "===================================================="

        );

        /*
        |--------------------------------------------------------------------------
        | Berhasil
        |--------------------------------------------------------------------------
        */
        if (
            isset($result['detail']) &&
            str_contains(
                strtolower($result['detail']),
                'success'
            )
        ) {

            return [

                'success' => true,

                'message' => 'Resi berhasil dikirim ke WhatsApp.',

                'url_resi' => $hasilResi['url'],

                'nama_file' => $hasilResi['nama_file'],

            ];

        }

        /*
        |--------------------------------------------------------------------------
        | Gagal
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | Simpan Response Error Meta
        |--------------------------------------------------------------------------
        */

        Log::error(

            "\n"

            . "=============== ERROR META API ===============\n"

            . json_encode(
                $result,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )

            . "\n"

            . "=============================================="

        );
        return [

            'success' => false,

            'message' => 'Resi gagal dikirim.',

            'response' => $result

        ];
    }
}