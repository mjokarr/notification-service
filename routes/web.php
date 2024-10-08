<?php

use App\Models\User;
use App\Mail\TopicCreated;
use App\Mail\UserRegisted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Services\Notifications\Notification;
use App\Http\Controllers\NotificationsController;

// Route::get('/', function()
// {
//     $notification = resolve(Notification::class);
//     // $notification->sendEmail(User::find(1), new TopicCreated);
//     $notification->sendSms(User::find(1), 'یک پیام تستی از پروژه نوتیفیکیشن');
//     $notification->sendEmail();
// });

Route::get('/home', function ()
{
    return view('home');
});
Route::get('notification/send-email', [NotificationsController::class, 'email'])->name('notification.for.email');
Route::post('notification/send-email', [NotificationsController::class, 'sendEmail'])->name('notification.send.email');
Route::get('notification/send-sms', [NotificationsController::class, 'sms'])->name('notification.for.sms');
Route::post('notification/send-sms', [NotificationsController::class, 'sendSms'])->name('notification.send.sms');