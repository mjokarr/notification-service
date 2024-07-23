<?php

use App\Models\User;
use App\Mail\TopicCreated;
use App\Mail\UserRegisted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Services\Notifications\Notification;

Route::get('/', function()
{
    $notification = resolve(Notification::class);
    // $notification->sendEmail(User::find(1), new TopicCreated);
    $notification->sendSms(User::find(1), 'یک پیام تستی از پروژه نوتیفیکیشن');
});