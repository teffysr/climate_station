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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/{station}/historic', 'HomeController@showHistory')->name('in_construction');
Route::get('/calculos', 'CalculosController@index')->name('calculos');


Route::get('/porcentajes', 'PercentageController@index')->name('percentage');
Route::get('/porcentajes/{station}/valores', 'PercentageController@show')->name('percentage_value');
Route::post('/porcentajes/{station}/update', 'PercentageController@update')->name('percentage_update');
