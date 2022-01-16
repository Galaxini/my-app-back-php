<?php

/** @var \Laravel\Lumen\Routing\Router $router */
// $router->post('getItems', 'MainController@getItems'); 
$router->group(['prefix' => 'item'], function () use ($router) {
  $router->post('add', 'MainController@addItems');
  $router->get('list', 'MainController@getItems');
});
$router->group(['prefix' => 'auth'], function () use ($router) {
  // Matches "/api/register
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
