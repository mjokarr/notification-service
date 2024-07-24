<?php

namespace App\Services\Notifications\Providers;

use App\Models\User;
use App\Services\Notifications\providers\Contracts\Provider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class EmailProvider implements Provider
{
    private $user;
    private $mailable;
    
    public function __construct(User $user, Mailable $mailable)
    {
        $this->user = $user;
        $this->mailable = $mailable;
    }

    public function send()
    {
        return Mail::to($this->user)->send($this->mailable);
    }    
}
