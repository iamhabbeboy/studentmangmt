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

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'account'], function () {
    Route::post('/auth', 'StudentController@auth');
    Route::get('/login', 'StudentController@login');
    Route::post('/login-auth', 'StudentController@loginAuth');
    Route::get('/dashboard', 'StudentController@dashboard')->middleware('restrict');
    Route::post('/payment', 'StudentController@payment')->middleware('restrict');
    Route::get('/course', 'StudentController@course')->middleware('restrict');
    Route::get('/logout', 'StudentController@logout');
    Route::post('/fetch-course', 'StudentController@fetchCourse');
    Route::post('/course-register', 'StudentController@registerCourse');
    Route::post('/retrieve-registered', 'StudentController@retrieveRegistered');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/add-course', 'HomeController@store');
Route::post('/applicant', 'HomeController@applicant');
