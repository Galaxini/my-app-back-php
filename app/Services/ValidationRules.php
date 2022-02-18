<?php

namespace App\Services;

class ValidationRules
{
    public static $addItems = [
        'title' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|integer',
    ];

    public static function get(?string $type = null)
    {
        return self::$$type;
    }
}