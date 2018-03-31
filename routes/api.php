<?php

use Illuminate\Http\Request;

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

// Login
Route::post('auth/login', 'Demo\DemoController@login');

// Register
Route::post('auth/register', 'Demo\DemoController@register');

// Refresh Token
Route::post('refresh', 'Demo\DemoController@refresh')->middleware('jwt.auth');

// Test
Route::post('test', 'Demo\DemoController@test')->middleware('jwt.auth');

// 文件上传测试
Route::post('file/upload', 'Demo\DemoController@upload')->middleware('jwt.auth');

// 另一个模块
Route::resource('another', 'AnotherModule\TestController', ['only' => ['index', 'create', 'store']]);
