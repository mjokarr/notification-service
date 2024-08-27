<?php

namespace App\Jobs;

use App\Models\User;
use App\Services\Notifications\Notification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmail implements ShouldQueue
{
    private $user;
    private $mailable;

    use Queueable;
    
    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Mailable $mailable)
    {  
        $this->user = $user;
        $this->mailable = $mailable;
    }

    /**
     * Execute the job.
     */
    public function handle(Notification $notification)
    {
        return $notification->sendEmail($this->user, $this->mailable);
    }
}
