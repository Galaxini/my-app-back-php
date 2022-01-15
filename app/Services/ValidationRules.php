<?php

namespace App\Services;

class ValidationRules
{
    public static $addItems = [
        'title' => 'required|string',
        'description' => 'required|string',
        'user_id' => 'required|string',
        'title' => 'required|string',
        'price' => 'required|string',
        // 'device' => 'required|string'
    ];

    public static function get(?string $type = null)
    {
        return self::$$type;
    }
}