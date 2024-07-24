<?php

namespace App\Services\Notifications\Providers;

use App\Models\User;
use App\Services\Notifications\providers\Contracts\Provider;
use Kavenegar\KavenegarApi;

class SmsProvider implements Provider
{
    private $user;
    private $message;
    
    public function __construct(User $user, string $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function send()
    {
        try{
            $api = new KavenegarApi( config('services.sms.uri') );
            $sender = "10008663";
            $message = $this->message;
            $receptor = $this->user->phone_number;
            $result = $api->Send($sender,$receptor,$message);
            if($result){
                foreach($result as $r){
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }		
            }
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
    
            echo 'Response is not ok: ' . $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            echo 'Connection Failed: ' . $e->errorMessage();
        }
    }
}
