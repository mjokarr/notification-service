<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Jobs\SendSms;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Contracts\Mail\Mailable;
use App\Services\Notifications\Notification;
use App\Services\Notifications\Constants\EmailTypes;
use App\Services\Notifications\Exceptions\UserDoesNotHaveNumber;

class NotificationsController extends Controller
{
    public function email()
    {
        $users = User::all();
        $emailTypes = EmailTypes::toString();
        return view('notifications.send-email', compact('users', 'emailTypes'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'user' => 'integer | exists:users,id',
            'email_type' => 'integer',
        ]);

        try {

            
            # after use queue service, deleted this line. 
            // $notificationService = resolve(Notification::class);
            
            $mailable = EmailTypes::toMail($request->email_type);
            SendEmail::dispatch(User::find($request->user), new $mailable);

            return redirect()->back()->with('success', __('notification.email_sent_successfully'));

        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', __('notification.email_has_problem'));
        }
    }

    public function sms()
    {
        $users = User::all();
        return view('notifications.send-sms', compact('users'));
    }

    # notice:
    # if we set Notification servise as seccond method arguman, laravel destinguesh and new that atumatically.
    # that rule's name is <auto wiring>.     
    public function sendSms(Request $request)
    {
        $request->validate([
            'user' => 'integer | exists:users,id',
            'text' => 'string | max:256',
        ]);
        
        try 
        {
            SendSms::dispatch(User::find($request->user), $request->text);
            return $this->redirectBack('success', __('notification.sms_sent_successfully')); 

        }
        catch (Exception $e)
        {
            return $this->redirectBack('failed', __('notification.sms_service_have_problem'));
        }
    }

    private function redirectBack($type, $text)
    {
        return redirect()->back()->with($type, $text);   
    }
}
