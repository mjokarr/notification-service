<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\Notifications\Notification;

class SendSms implements ShouldQueue
{
    private $user; 
    private $text;
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, $text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Execute the job.
     */
    public function handle(Notification $notification)
    {
        return $notification->sendSms($this->user, $this->text);
    }
}
