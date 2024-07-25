<?php

namespace App\Services\Notifications\Constants;

use App\Mail\ForgetPassword;
use App\Mail\TopicCreated;
use App\Mail\UserRegisted;
use InvalidArgumentException;

class EmailTypes
{
    const USER_REGISTERD = 1;
    const TOPIC_CREATED = 2;
    const FORGET_PASSWORD = 3;

    public static function toString()
    {
        return [
            self::USER_REGISTERD => 'ثبت‌ نام کاربر', 
            self::TOPIC_CREATED => 'ایجاد مقاله جدید',
            self::FORGET_PASSWORD => 'فراموشی رمزعبور',
        ];
    }

    public static function toMail($type)
    {
        try {
        /** $types = */ return [
            self::USER_REGISTERD => UserRegisted::class,
            self::TOPIC_CREATED => TopicCreated::class,
            self::FORGET_PASSWORD => ForgetPassword::class,
        ][$type];
        /** 
         * return $types[$type];
         */
        } catch (\Throwable $th) {
            throw new InvalidArgumentException('Mailable class dos not exist!');
        }

    }

}
