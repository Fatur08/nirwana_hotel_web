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

            default:

                throw new \Exception('Provider WhatsApp tidak ditemukan.');

        }
    }

    public function sendText($target, $message)
    {
        return $this->provider->sendText($target, $message);
    }
}