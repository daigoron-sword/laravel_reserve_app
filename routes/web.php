<?php

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

Route::get('/', 'HomeController@index')->name('index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/reserve', 'ReserveController@index');
Route::get('/reserve/rooms', 'ReserveController@select_room');
Route::get('/reserve/meals_plans', 'ReserveController@select_meal_plan');
Route::get('/reserve/fill', 'ReserveController@fill');
Route::post('/reserve/check', 'ReserveController@check');
Route::post('/reserve/thanks', 'ReserveController@thanks');

