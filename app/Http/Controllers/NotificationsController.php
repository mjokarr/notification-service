<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\Notifications\Notification;
use App\Services\Notifications\Constants\EmailTypes;

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

            // $mailable = EmailTypes::toMail($request->email_type);
            $notificationService = resolve(Notification::class);
            $notificationService->sendEmail(User::find($request->user), new $mailable);
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
    public function sendSms(Request $request, Notification $notification)
    {
        $request->validate([
            'user' => 'integer | exists:users,id',
            'text' => 'string | max:256',
        ]);
        
        $notification->sendSms(User::find($request->user), $request->text);
        return redirect()->back()->with('success', __('notification.sms_sent_successfully'));
    }

}
