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
});

//mission Routes
Route::group(['middleware'=> ['web','auth']],function(){
    Route::resource('mission','\App\Http\Controllers\MissionController');
    Route::post('mission/{id}/update','\App\Http\Controllers\MissionController@update');
    Route::get('mission/{id}/delete','\App\Http\Controllers\MissionController@destroy');
    Route::get('mission/{id}/assign','\App\Http\Controllers\MissionController@assign');//指派
    Route::post('mission/{id}/division','\App\Http\Controllers\MissionController@division');//分割
    Route::get('mission/{id}/deleteMsg','\App\Http\Controllers\MissionController@DeleteMsg');
    Route::get('mission/{id}/template','\App\Http\Controllers\MissionController@create');
    Route::get('mission/{id}/start','\App\Http\Controllers\MissionController@start');
    Route::get('mission/{id}/complete','\App\Http\Controllers\MissionController@complete');
    Route::get('choose','\App\Http\Controllers\MissionController@choose');
});

//mission_template Routes
Route::group(['middleware'=> ['web','auth']],function(){
    Route::resource('mission_template','\App\Http\Controllers\Mission_templateController');
    Route::post('mission_template/{id}/update','\App\Http\Controllers\Mission_templateController@update');
    Route::get('mission_template/{id}/delete','\App\Http\Controllers\Mission_templateController@destroy');
    Route::get('mission_template/{id}/deleteMsg','\App\Http\Controllers\Mission_templateController@DeleteMsg');
});

//log Routes
Route::group(['middleware'=> ['web','auth']],function(){
    Route::resource('log','\App\Http\Controllers\LogController');
    Route::post('log/{id}/update','\App\Http\Controllers\LogController@update');
    Route::get('log/{id}/delete','\App\Http\Controllers\LogController@destroy');
    Route::get('log/{id}/deleteMsg','\App\Http\Controllers\LogController@DeleteMsg');
});


Route::group(['middleware'=> ['web','auth']],function(){
    Route::get('/home','\App\Http\Controllers\HomeController@index');
    Route::post('work','\App\Http\Controllers\StaffWorkLogController@store');
    Route::get('/','\App\Http\Controllers\HomeController@home');
});
Auth::routes();

