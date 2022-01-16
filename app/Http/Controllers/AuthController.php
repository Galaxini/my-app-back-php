<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\AuthServices;
// use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    const PASSWORD_SALT = 'Наглый коричневый лисёнок прыгает вокруг ленивой собаки.';
    const HASH_ALGO = 'md5';
    private $authServices;
    public function __construct()
    {
      $this->authServices = new AuthServices;
    }
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = User::getHash($plainPassword);
            $user->token = User::generateToken();
            $user->save();
            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => $e, 'pass' => hash(self::HASH_ALGO, $plainPassword)], 409);
        }

    }

    public function login(Request $request)
    {
          //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $email = $request->input('email');
        $plainPassword = $request->input('password');
        $response = $this->authServices->login($email, $plainPassword);
        if ($response) {
          return response()->json(['response' => $response], 200);
        }
        return response()->json(['message' => 'error'], 409);
    }

}
