<?php

use Illuminate\Http\Request;

Route::get('/not_sign_in', function () {
    return ['result' => 'false', 'response' => 'Please login first.'];
})->name('not_sign_in');

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'UsersController@store');


//一般使用者登入方法
Route::middleware('login')->group(function() {
    Route::post('/login', 'Auth\LoginController@store');
});

//admin登入方法
Route::middleware('login', 'is_Admin')->prefix('admin')->group(function () {
        Route::post('/', 'Auth\AdminController@index');
});
