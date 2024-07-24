<?php 
namespace App\Services\Notifications;

use App\Services\Notifications\providers\Contracts\Provider;
use Exception;
use App\Models\User;

class Notification 
{

    /**
     * @method SmsProvider(\App\Models\User $user, String $message)
     * @method EmailProvider(\App\Models\User $user, \Illuminate\Mail\Mailable $mailable)
     */
    // public function sendEmail(User $user, Mailable $mailable)
    // {
    //     $emailProvider = new EmailProvider();
    //     return $emailProvider->send($user, $mailable);
    // }


    // public function sendSms(User $user, String $message)
    // {
    //     $smsProvider = new SmsProvider();
    //     return $smsProvider->send($user, $message);
    // }


    ##### Instead of the above cods: #####
    # Dinamically: with validation.
    public function __call(String $name, Array $arguments)
    {
        $providerPath = __NAMESPACE__ . '\providers\\' . substr($name, 4) . 'Provider'; 

        if(!class_exists($providerPath))
        {
            throw new Exception('The class name dos not exist!!');
        }

        $providerInstance = new $providerPath(... $arguments);

        if(!is_subclass_of($providerInstance, Provider::class))
        {
            throw new Exception('the class, must be a subclass of App\Services\Notifications\providers\Contracts\Provider');
        }
        return $providerInstance->send();
    }
}