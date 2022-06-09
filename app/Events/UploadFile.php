<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UploadFile
{
    use Dispatchable;
    use SerializesModels;

    public string $message;
    public User $user;

    public function __construct(string $message, User $user)
    {
        $this->message = $message;
        $this->user = $user;
    }
}
