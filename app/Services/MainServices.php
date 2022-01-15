<?php

namespace App\Services;

use DB;
use App\Models\User;
use App\Models\Items;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;

class MainServices
{
    public static function getItems($request)
    {
      $data = Items::select('*')
      ->get();
        return response()->json(
            [
                'status' => 'success',
                'data' => $data
            ], 200);
    }
    public static function addItems($request)
    {
      try {
        $incoming_user_data = $request->only([
          'title',
          'description',
          'user_id',
          'price',
      ]);
        Items::create([
          'title' => $request->input('title'),
          'description' => $request->input('description'),
          'user_id' => $request->input('user_id'),
          'price' => $request->input('price'),
      ]);
        //return successful response
        return response()->json(['message' => 'CREATED'], 201);

    } catch (\Exception $e) {
        //return error message
        return response()->json(['message' => $e], 409);
    }
    }
  }