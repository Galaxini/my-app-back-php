<?php

/** @var \Laravel\Lumen\Routing\Router $router */
// $router->post('getItems', 'MainController@getItems'); 
$router->group(['prefix' => 'item'], function () use ($router) {
  $router->post('addItems', 'MainController@addItems');
  $router->get('getItems', 'MainController@getItems');
  $router->get('getUsersWithItems', 'MainController@getUsersWithItems');
  $router->post('editItems', 'MainController@editItems');
  $router->post('deleteItems', 'MainController@deleteItems');
});
$router->group(['prefix' => 'auth'], function () use ($router) {
  $router->post('register', 'AuthController@register');
  $router->post('login', 'AuthController@login');
  $router->get('refresh', 'AuthController@refresh');
  $router->get('logout', 'AuthController@logout');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
  return "UP AND RUNNING";
});
