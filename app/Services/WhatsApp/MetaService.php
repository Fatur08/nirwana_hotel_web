<?php

namespace App\Services\WhatsApp;

use Illuminate\Support\Facades\Http;

class MetaService
{
    private string $token;
    private string $phoneNumberId;
    private string $version;

    public function __construct()
    {
        $this->token = config('services.whatsapp.meta.token');
        $this->phoneNumberId = config('services.whatsapp.meta.phone_number_id');
        $this->version = config('services.whatsapp.meta.version');
    }

    public function sendText(string $target, string $message)
    {
        $url = "https://graph.facebook.com/{$this->version}/{$this->phoneNumberId}/messages";

        return Http::withToken($this->token)
            ->post($url, [

                'messaging_product' => 'whatsapp',

                'to' => $target,

                'type' => 'text',

                'text' => [

                    'preview_url' => false,

                    'body' => $message,

                ],

            ])
            ->json();
    }

}