<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'user_id',
        'price'
    ];
}