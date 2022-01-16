<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\MainServices;
use App\Services\ValidationRules;
use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\AuthServices;

class MainController extends Controller
{
  private $authServices;
  public function __construct()
  {
    $this->authServices = new AuthServices;
  }
  public function getItems(Request $request)
    {
      
      $data = MainServices::getItems();
      return response()->json(
        [
            'status' => 'success',
            'data' => $data
        ], 200);
    }
  public function addItems(Request $request)
  {
      $this->validate($request, ValidationRules::get('addItems'));
      if ($request->input('token') == null) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $user = $this->authServices->getUserByToken($request->input('token'));
      if ($user === false) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $values = [
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'user_id' => $user->id,
        'price' => $request->input('price'),
      ];
      $response = MainServices::addItems($values);
      if ($response) {
        return response()->json(['message' => 'CREATED'], 201);
      }
      return response()->json(['message' => 'ERROR'], 409);
  }
}
