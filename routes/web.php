<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','GuestController@index');
Route::get('/home', function () {
    return view('welcome.blade.php');
});

Auth::routes();


Route::group(['middleware'=>'web'], function(){

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){

	Route::resource('modelis', 'ModelisController');
	Route::resource('barangs', 'BarangsController');
	Route::resource('transaksis', 'TransaksisController');
});
});
Route::get('/home','HomeController@index');
Route::get('/test', function () {
    return view('barangs.gallery');
});
