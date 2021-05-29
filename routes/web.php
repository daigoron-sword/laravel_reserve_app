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
Route::get('/reserve', 'ReserveController@index')->name('reserve');
Route::get('/reserve/rooms', 'ReserveController@select_room')->name('reserve.rooms');
Route::post('/reserve/meals_plans', 'ReserveController@select_meal_plan')->name('reserve.meals_plans');
Route::post('/reserve/fill', 'ReserveController@fill')->name('reserve.fill');
Route::post('/reserve/check', 'ReserveController@check')->name('reserve.check');
Route::post('/reserve/thanks', 'ReserveController@thanks');

Route::get('/management', 'ManagementController@reserveManagement')->name('management');
Route::get('/management/editRoom/{id}', 'ManagementController@editRoom')->name('editRoom');
Route::post('/management/editRoom/{id}', 'ManagementController@finishRoom')->name('finishRoom');
Route::get('/management/edit/{id}', 'ManagementController@edit')->name('edit');


