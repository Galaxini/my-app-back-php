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
    public static function getItems()
    {
      $data = Items::select('*')
      ->get();
      return $data;
    }
    public static function addItems($values)
    {
      try {
        Items::create([
          'title' => $values['title'],
          'description' => $values['description'],
          'user_id' => $values['user_id'],
          'price' => $values['price'],
        ]);
        //return successful response
        return true;

      } catch (\Exception $e) {
          //return error message
          return false;
      }
    }
    public static function getUsersWithItems($values) {
      $userId = $values['user_id'];
      $data = User::select('*')
      ->leftJoin('items', 'users.id', '=', 'items.user_id')
      ->where('users.id', $userId)
      ->get();
      return $data;
    }
    public static function editItems($values) {
      {
        try {
          Items::where('user_id', $values['user_id'])
          ->where('id', $values['id'])
          ->update([
            'title' => $values['title'],
            'description' => $values['description'],
            'price' => $values['price'],
          ]);
          //return successful response
          return true;
  
        } catch (\Exception $e) {
            //return error message
            return false;
        }
      }
    }
    public static function deleteItems($values) {
      {
        try {
          Items::where('user_id', $values['user_id'])
          ->where('id', $values['id'])
          ->delete();
          //return successful response
          return true;
  
        } catch (\Exception $e) {
            //return error message
            return false;
        }
      }
    }
  }