<?php

namespace App\Services\WhatsApp;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public function sendText($target, $message)
    {
        return Http::withHeaders([
            'Authorization' => config('services.fonnte.token'),
        ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                ]);
    }

    public function sendImage($target, $message, $url)
    {
        return Http::withHeaders([
            'Authorization' => config('services.fonnte.token'),
        ])->asForm()->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'url' => $url,
                ]);
    }
}