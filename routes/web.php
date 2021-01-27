<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Cache;
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

Route::get('/', '\App\Http\Controllers\InicioController@index')->name('inicio.index');

// Route::get('/cache', function () {
//     return Cache::get('key');
// });

// Laravel 7.x
Route::get('/apuntes', '\App\Http\Controllers\ApunteController@index')->name('apuntes.index');
Route::get('/apuntes/create', '\App\Http\Controllers\ApunteController@create')->name('apuntes.create');
Route::post('/apuntes', '\App\Http\Controllers\ApunteController@store')->name('apuntes.store');
Route::get('/apuntes/{apunte}', '\App\Http\Controllers\ApunteController@show')->name('apuntes.show');
Route::get('/apuntes/{apunte}/edit', '\App\Http\Controllers\ApunteController@edit')->name('apuntes.edit');
Route::put('/apuntes/{apunte}', '\App\Http\Controllers\ApunteController@update')->name('apuntes.update');
Route::delete('/apuntes/{apunte}', '\App\Http\Controllers\ApunteController@destroy')->name('apuntes.destroy');

Route::get('/modulo/{moduloApunte}', '\App\Http\Controllers\ModulosController@show')->name('modulos.show');

//Buscador de apuntes
Route::get('/buscar', 'ApunteController@search')->name('buscar.show');

// Route::resource('apuntes', 'ApunteController');

Route::get('/perfiles/{perfil}', '\App\Http\Controllers\PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit', '\App\Http\Controllers\PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', '\App\Http\Controllers\PerfilController@update')->name('perfiles.update');

// Laravel 8

//Almacenar Likes

Route::post('/apuntes/{apunte}', '\App\Http\Controllers\LikesController@update')->name('likes.update');


Auth::routes();

// Route::get('/home', '\App\Http\Controllers\HomeController@index')->name('home');
