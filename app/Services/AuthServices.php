<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthServices
{
   /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function logout () {
      Auth::logout();
      return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function refresh() {
      return $this->createNewToken(auth()->refresh());
    }

    public function login($email, $password)
    {
      try {
        $password = User::getHash($password);
        $user = User::where('email', $email)->where('password', $password)->first();
        $user->token = User::generateToken();
        $user->save();
        return $user;
      } catch(\Exception $e) {
        return false;
      }
    }

    public function getUserByToken($token) {
      $user = User::where('token', $token)->first();
      if ($user) {
        return $user;
      }
      return false;
    }
}