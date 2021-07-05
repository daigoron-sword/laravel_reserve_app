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

Route::get('/home', 'HomeController@home')->name('home');
Route::get('/reserve', 'ReserveController@index')->name('reserve');

Route::get('/reserve/rooms', 'ReserveController@select_room')->name('reserve.rooms');
Route::post('/reserve/room_seisson', 'ReserveController@room_session')->name('reserve.room_session');

Route::get('/reserve/meals_plans', 'ReserveController@select_meal_plan')->name('reserve.meals_plans');
Route::post('/reserve/meal_plan_session', 'ReserveController@meal_plan_session')->name('reserve.meal_plan_session');

Route::get('/reserve/fill', 'ReserveController@fill')->name('reserve.fill');
Route::post('/reserve/customer_sesson', 'ReserveController@customer_session')->name('reserve.customer_session');


Route::get('/reserve/check', 'ReserveController@check')->name('reserve.check');
Route::post('/reserve/send', 'ReserveController@send')->name('reserve.send');

Route::get('/reserve/thanks', 'ReserveController@thanks');


Route::get('/management', 'ManagementController@reserveManagement')->name('management');
Route::get('/management/editRoom/{id}', 'ManagementController@editRoom')->name('editRoom');
Route::post('/management/editRoom/{id}', 'ManagementController@finishRoom')->name('finishRoom');
Route::get('/management/editPlan/{id}', 'ManagementController@editPlan')->name('editPlan');
Route::post('/management/editPlan/{id}', 'ManagementController@finishPlan')->name('finishPlan');
Route::get('/management/deleteReserve/{id}', 'ManagementController@deleteReserve')->name('deleteReserve');
Route::post('/management/deleteReserve/{id}', 'ManagementController@removeReserve')->name('removeReserve');
Route::get('/management/salesChart', 'ManagementController@salesChart')->name('salesChart');


Route::get('/management/source', 'ManagementController@sourceManagemet')->name('sourceManagemet');
Route::get('/management/source/create', 'ManagementController@createSource')->name('createSource');
Route::post('/management/source/create', 'ManagementController@creatingSource')->name('creatingSource');
Route::get('/management/source/edit/{id}', 'ManagementController@editSource')->name('editSource');
Route::post('/management/source/edit/{id}', 'ManagementController@finishSource')->name('finishSource');
Route::get('/management/source/delete/{id}', 'ManagementController@editSource')->name('deleteSource');
Route::post('/management/source/delete/{id}', 'ManagementController@removeSource')->name('removeSource');