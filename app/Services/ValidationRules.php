<?php

namespace App\Services;

class ValidationRules
{
    public static $addItems = [
        'title' => 'required|string',
        'description' => 'required|string',
        'user_id' => 'required|string',
        'price' => 'required|integer',
        // 'device' => 'required|string'
    ];

    public static function get(?string $type = null)
    {
        return self::$$type;
    }
}