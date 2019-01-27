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

Route::get('/student', 'StudentController@index');
Route::post('/student', 'StudentController@store');
Route::put('/student', 'StudentController@update');
Route::delete('/student', 'StudentController@delete');

//--------- COURSES
Route::get('/course', 'CourseController@index');
Route::post('/course', 'CourseController@store');
Route::put('/course', 'CourseController@update');
Route::delete('/course/{id}', 'CourseController@delete');
