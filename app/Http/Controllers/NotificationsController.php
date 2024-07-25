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
        return view('notification.send-email', compact('users', 'emailTypes'));
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
}
