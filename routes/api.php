<?php

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

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

// super admin routes
Route::group([
    'middleware' => ['jwt.auth']
], function () {
    Route::post('user/lesson', 'UserController@assignLesson');
    Route::delete('user/lesson', 'UserController@revokeLesson');
    Route::post('user/supporter', 'UserController@assignSupporter');
    Route::delete('user/supporter', 'UserController@revokeSupporter');

    Route::apiResource('user', 'UserController');
    Route::apiResource('school', 'SchoolController');
    Route::apiResource('lesson', 'LessonController');
});
