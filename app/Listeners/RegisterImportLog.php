<?php

namespace App\Listeners;

use App\Events\UploadFile;
use Illuminate\Support\Facades\Log;

class RegisterImportLog
{
    public function handle(UploadFile $event)
    {
        Log::info('Import ' . $event->message, [
            'user' => $event->user->email,
            'date' => now(),
        ]);
    }
}
