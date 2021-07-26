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


Auth::routes();
Route::get('/', 'ReserveController@index');

// 予約のルーティング
Route::prefix('reserve')->group(function(){
    Route::get('/', 'ReserveController@index')->name('reserve');
    Route::get('rooms', 'ReserveController@select_room')->name('reserve.rooms');
    Route::post('room_session', 'ReserveController@room_session')->name('reserve.room_session');
    Route::get('meals_plans', 'ReserveController@select_meal_plan')->name('reserve.meals_plans');
    Route::post('meal_plan_session', 'ReserveController@meal_plan_session')->name('reserve.meal_plan_session');
    Route::get('fill', 'ReserveController@fill')->name('reserve.fill');
    Route::post('customer_session', 'ReserveController@customer_session')->name('reserve.customer_session');
    Route::get('check', 'ReserveController@check')->name('reserve.check');
    Route::post('send', 'ReserveController@send')->name('reserve.send');
});

// 予約管理のルーティング
Route::prefix('management')->group(function(){
    Route::get('/', 'ManagementController@reserveManagement')->name('management');
    Route::get('editRoom/{id}', 'ManagementController@editRoom')->name('editRoom');
    Route::post('editRoom/{id}', 'ManagementController@finishRoom')->name('finishRoom');
    Route::get('editPlan/{id}', 'ManagementController@editPlan')->name('editPlan');
    Route::post('editPlan/{id}', 'ManagementController@finishPlan')->name('finishPlan');
    Route::get('deleteReserve/{id}', 'ManagementController@deleteReserve')->name('deleteReserve');
    Route::post('deleteReserve/{id}', 'ManagementController@removeReserve')->name('removeReserve');
    Route::get('salesChart', 'ManagementController@salesChart')->name('salesChart');
});

// ソース管理のルーティング
Route::prefix('management/source')->group(function(){
    Route::get('/', 'ManagementController@sourceManagemet')->name('sourceManagemet');
    Route::get('create', 'ManagementController@createSource')->name('createSource');
    Route::post('create', 'ManagementController@creatingSource')->name('creatingSource');
    Route::get('edit/{id}', 'ManagementController@editSource')->name('editSource');
    Route::post('edit/{id}', 'ManagementController@finishSource')->name('finishSource');
    Route::get('delete/{id}', 'ManagementController@editSource')->name('deleteSource');
    Route::post('delete/{id}', 'ManagementController@removeSource')->name('removeSource');
});
