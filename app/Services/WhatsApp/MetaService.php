<?php

namespace App\Services\WhatsApp;

use Illuminate\Support\Facades\Http;

class MetaService
{
    private string $token;
    private string $phoneNumberId;

    public function __construct()
    {
        $this->token = config('services.whatsapp.meta.token');
        $this->phoneNumberId = config('services.whatsapp.meta.phone_number_id');
    }

    // sendText()
    // sendImage()
}