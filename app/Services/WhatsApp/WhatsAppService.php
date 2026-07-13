<?php

namespace App\Services\WhatsApp;

class WhatsAppService
{
    protected $provider;

    public function __construct()
    {
        $provider = config('services.whatsapp.provider');

        switch ($provider) {

            case 'fonnte':

                $this->provider = new FonnteService();

                break;

            case 'meta':

                $this->provider = new MetaService();

                break;

            default:

                throw new \Exception(
                    'Provider WhatsApp tidak ditemukan.'
                );

        }
    }











    /**
     * Normalisasi nomor WhatsApp
     *
     * Contoh:
     * 081234567890
     * 0812 3456 7890
     * 0812-3456-7890
     * 0812.3456.7890
     * +6281234567890
     * (+62)81234567890
     *
     * Menjadi:
     * 6281234567890
     */
    public function normalizeNumber($number)
    {
        /*
        |--------------------------------------------------------------------------
        | Pastikan berupa string
        |--------------------------------------------------------------------------
        */
        $number = (string) $number;

        /*
        |--------------------------------------------------------------------------
        | Hilangkan spasi di awal dan akhir
        |--------------------------------------------------------------------------
        */
        $number = trim($number);

        /*
        |--------------------------------------------------------------------------
        | Sisakan hanya angka dan tanda +
        |--------------------------------------------------------------------------
        */
        $number = preg_replace(
            '/[^0-9+]/',
            '',
            $number
        );

        /*
        |--------------------------------------------------------------------------
        | Hilangkan tanda +
        |--------------------------------------------------------------------------
        */
        $number = ltrim(
            $number,
            '+'
        );

        /*
        |--------------------------------------------------------------------------
        | Jika masih diawali 0
        | Contoh:
        | 081234567890
        |--------------------------------------------------------------------------
        */
        if (str_starts_with($number, '0')) {

            $number = '62' . substr(
                $number,
                1
            );

        }

        /*
        |--------------------------------------------------------------------------
        | Jika sudah diawali 62
        |--------------------------------------------------------------------------
        */ elseif (str_starts_with($number, '62')) {

            // Tidak perlu diubah

        }

        /*
        |--------------------------------------------------------------------------
        | Jika tidak diawali 0 ataupun 62
        | Misal:
        | 81234567890
        |--------------------------------------------------------------------------
        */ else {

            $number = '62' . $number;

        }






        return $number;
    }








    public function sendText($target, $message)
    {
        return $this->provider->sendText(
            $this->normalizeNumber($target),
            $message
        );
    }








    public function sendImage($target, $message, $media)
    {
        return $this->provider->sendImage(
            $this->normalizeNumber($target),
            $message,
            $media
        );
    }









    /**
     * Upload media ke provider
     */
    public function uploadMedia($filePath)
    {
        return $this->provider->uploadMedia(
            $filePath
        );
    }
}