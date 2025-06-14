<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService
{
    public static function reservation($message, array $context = [])
    {
        Log::channel('reservations')->info($message, $context);
    }

    public static function approval($message, array $context = [])
    {
        Log::channel('approvals')->info($message, $context);
    }

    public static function auth($message, array $context = [])
    {
        Log::channel('auth')->info($message, $context);
    }
}
