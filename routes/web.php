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
    return view('welcome');
});


Route::get('/logout','LogoutCotroller@logout');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/employeehome','HomeController@indexemployee');


Route::get('/phatologysts','HomeController@indexphatologsts');


Route::get('/adminhome', 'HomeController@indexadmin');


Route::get('/employeehome/search','HomeController@search');



Route::post('/createtest','TestController@createTest');

Route::post('/createreception','ReceptionController@createreception');


