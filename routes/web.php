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

//staff Routes
Route::group(['middleware'=> ['web','auth']],function(){
    Route::resource('staff','\App\Http\Controllers\StaffController');
    Route::post('staff/{id}/update','\App\Http\Controllers\StaffController@update');
    Route::get('staff/{id}/delete','\App\Http\Controllers\StaffController@destroy');
    Route::get('staff/{id}/deleteMsg','\App\Http\Controllers\StaffController@DeleteMsg');

    Route::resource('mission','\App\Http\Controllers\MissionController');
    Route::post('mission/{id}/update','\App\Http\Controllers\MissionController@update');
    Route::get('mission/{id}/delete','\App\Http\Controllers\MissionController@destroy');
    Route::get('mission/{id}/assign','\App\Http\Controllers\MissionController@assign');//指派
    Route::post('mission/{id}/division','\App\Http\Controllers\MissionController@division');//分割
    Route::get('mission/{id}/deleteMsg','\App\Http\Controllers\MissionController@DeleteMsg');
    Route::get('mission/{id}/template','\App\Http\Controllers\MissionController@create');
    Route::get('mission/{id}/start','\App\Http\Controllers\MissionController@start');
    Route::get('mission/{id}/complete','\App\Http\Controllers\MissionController@complete');
    Route::get('mission/{id}/remark','\App\Http\Controllers\MissionController@showRemarkForm');
    Route::get('choose','\App\Http\Controllers\MissionController@choose');


    Route::resource('mission_template','\App\Http\Controllers\Mission_templateController');
    Route::post('mission_template/{id}/update','\App\Http\Controllers\Mission_templateController@update');
    Route::get('mission_template/{id}/delete','\App\Http\Controllers\Mission_templateController@destroy');
    Route::get('mission_template/{id}/deleteMsg','\App\Http\Controllers\Mission_templateController@DeleteMsg');

    Route::resource('devices','\App\Http\Controllers\DeviceController');
    Route::post('devices/{id}/update','\App\Http\Controllers\DeviceController@update');
    Route::get('devices/{id}/delete','\App\Http\Controllers\DeviceController@destroy');
    Route::get('devices/{id}/deleteMsg','\App\Http\Controllers\DeviceController@DeleteMsg');

    Route::resource('log','\App\Http\Controllers\LogController');
    Route::post('log/{id}/update','\App\Http\Controllers\LogController@update');
    Route::get('log/{id}/delete','\App\Http\Controllers\LogController@destroy');
    Route::get('log/{id}/deleteMsg','\App\Http\Controllers\LogController@DeleteMsg');

    Route::get('/home','\App\Http\Controllers\HomeController@index');
    Route::post('work','\App\Http\Controllers\StaffWorkLogController@store');
    Route::get('/','\App\Http\Controllers\HomeController@index');

    Route::get('reset', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

});


//等同于
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');



