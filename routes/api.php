<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'API\AuthApiController@register');
Route::post('login', 'API\AuthApiController@login');

Route::middleware('auth:api')->post('/cities', 'API\CityController@addCity');
Route::middleware('auth:api')->delete('/cities/{city}', 'API\CityController@removeCity');
