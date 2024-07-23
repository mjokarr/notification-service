<?php 
namespace App\Services\Notifications;
// require '../../../vendor/autoload.php';

use App\Models\User;
use GuzzleHttp\Client;
use Kavenegar\KavenegarApi;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Kavenegar\Exceptions\ApiException;
use PhpParser\Node\Stmt\TryCatch;

class Notification 
{
    public function sendEmail(User $user, Mailable $mailable)
    {
        return Mail::to($user)->send($mailable);
    }


    public function sendSms(User $user, String $message)
    {

        try{
            $api = new KavenegarApi( config('services.sms.uri') );
            $sender = "10008663";
            $message = $message;
            $receptor = $user->phone_number;
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