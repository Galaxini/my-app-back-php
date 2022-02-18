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
      if ($request->input('token') == null) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $user = $this->authServices->getUserByToken($request->input('token'));
      if ($user === false) {
        return response()->json(['message' => 'Unauth'], 403);
      }
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

  public function getUsersWithItems(Request $request)
  {
      if ($request->input('token') == null) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $user = $this->authServices->getUserByToken($request->input('token'));
      if ($user === false) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $values = [
        'user_id' => $user->id,
      ];
      $data = MainServices::getUsersWithItems($values);
      return response()->json(
        [
            'status' => 'success',
            'data' => $data
        ], 200);
  }
  public function editItems(Request $request)
  {
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
        'id' => $request->input('id'),
        'price' => $request->input('price'),
        'user_id' => $user->id,
      ];
      $response = MainServices::editItems($values);
      if ($response) {
        return response()->json(['message' => 'EDITED'], 201);
      }
      return response()->json(['message' => 'ERROR'], 409);
  }
  public function deleteItems(Request $request)
  {
      if ($request->input('token') == null) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $user = $this->authServices->getUserByToken($request->input('token'));
      if ($user === false) {
        return response()->json(['message' => 'Unauth'], 403);
      }
      $values = [
        'id' => $request->input('id'),
        'user_id' => $user->id,
      ];
      $response = MainServices::deleteItems($values);
      if ($response) {
        return response()->json(['message' => 'DELETED'], 201);
      }
      return response()->json(['message' => 'ERROR'], 409);
  }
}
