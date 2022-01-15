<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\MainServices;
use App\Services\ValidationRules;
use Laravel\Lumen\Routing\Controller as BaseController;

class MainController extends Controller
{
  public function __construct (){
    $this->middleware('auth');
  }
  public function getItems(Request $request)
    {
        return MainServices::getItems($request);
    }
  public function addItems(Request $request)
  {
      $this->validate($request, ValidationRules::get('addItems'));
      return MainServices::addItems($request);
  }
}
