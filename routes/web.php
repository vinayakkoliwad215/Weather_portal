<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();




Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->post('/add-city', 'Web\CityController@addCity')->name('addCity');

Route::middleware('auth')->get('/home', 'Web\CityController@getUserCities')->name('home');

Route::middleware('auth')->get('/show-alert-form/{city_id}', 'Web\WeatherAlertController@showAlertForm')->name('showAlertForm');

Route::middleware('auth')->post('/set-alert/{city_id}', 'Web\WeatherAlertController@setAlert')->name('setAlert');