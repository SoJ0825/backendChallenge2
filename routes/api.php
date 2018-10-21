<?php

use Illuminate\Http\Request;

//Route::get('/not_sign_in', function () {
//    return ['result' => 'false', 'response' => 'Please login first.'];
//})->name('not_sign_in');


Route::post('register', 'UsersController@store');

//一般使用者登入方法
Route::middleware('login', 'updateAPItoken')->post('/login', 'Auth\LoginController@login');

//admin登入方法
Route::middleware('login', 'is_Admin', 'updateAPItoken')->prefix('admin')->group(function () {
    Route::post('/', 'Auth\AdminController@index');
});


Route::middleware('auth:api')->group(function () {
    Route::post('/user/order', 'OrdersController@store');
    Route::post('/user/order/{orderID}', 'OrdersController@read');
    Route::post('/user/order/{orderID}/update', 'OrdersController@update');
});

Route::middleware('auth:api', 'is_Admin')->prefix('admin')->group(function (){
    Route::middleware('is_Admin')->post('/orders', 'Auth\AdminController@showAllOrders');
    Route::post('/merchandises', 'Auth\AdminController@showAllMerchandises');
    Route::delete('/orders/delete', 'Auth\AdminController@clearAllOrders');
});