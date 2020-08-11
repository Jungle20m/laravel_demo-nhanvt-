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


Route::get('zotas', 'ZotasController@index')->name('zotas.index');
Route::post('zotas', 'ZotasController@store')->name('zotas.store');
// Route::get('zotas/update', 'ZotasController@update')->name('zotas.update');
Route::delete('zotas/destroy', 'ZotasController@destroy')->name('zotas.destroy');

