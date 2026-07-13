<?php

namespace App\Services\Resi;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ResiService
{
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
        return
            "🏨 *NIRWANA HOTEL KALIANDA*\n\n"

            . "Halo *{$dataPesanan->nama_tamu}*,\n\n"

            . "Terima kasih telah memilih *Nirwana Hotel Kalianda* sebagai tempat menginap Anda.\n\n"

            . "Berikut kami kirimkan *Resi Pembayaran* dalam bentuk gambar yang dapat dibuka melalui tautan berikut:\n\n"

            . $urlResi . "\n\n"

            . "Silakan simpan resi tersebut sebagai bukti pembayaran.\n\n"

            . "📅 *Check In* : {$dataPesanan->check_in}\n"

            . "📅 *Check Out* : {$dataPesanan->check_out}\n\n"

            . "Apabila terdapat pertanyaan atau membutuhkan bantuan, silakan hubungi resepsionis kami.\n\n"

            . "Terima kasih atas kepercayaan Anda.\n\n"

            . "*NIRWANA HOTEL KALIANDA*";
    }
}