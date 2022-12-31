<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');



Route::group(['middleware' => 'auth'], function () {
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::delete('deleteuser/{id}', 'App\Http\Controllers\UserController@destroy')->name('users.destroy');
});

//rutas de zona
Route::group(['middleware' => 'auth'], function () {
    Route::GET('zonas','App\Http\Controllers\ZonaController@index')->name('zonas.index');
    Route::POST('zonas','App\Http\Controllers\ZonaController@store')->name('zonas.store');
    Route::DELETE('delete-zona/{id}','App\Http\Controllers\ZonaController@destroy')->name('zonas.destroy');
    Route::POST('update','App\Http\Controllers\ZonaController@update')->name('zonas.update');
});

//rutas de cliente
Route::group(['middleware' => 'auth'], function () {
    Route::GET('clientes','App\Http\Controllers\ClienteController@index')->name('clientes.index');
    Route::POST('clientes','App\Http\Controllers\ClienteController@store')->name('clientes.store');
    Route::DELETE('delete-cliente/{id}','App\Http\Controllers\ClienteController@destroy')->name('clientes.destroy');
    Route::POST('update-cliente','App\Http\Controllers\ClienteController@update')->name('clientes.update');
});

//rutas de documento
Route::group(['middleware' => 'auth'], function () {
    Route::DELETE('delete-documento/{id}','App\Http\Controllers\DocumentoController@destroy')->name('documentos.destroy');
    Route::POST('update-documento/{id}','App\Http\Controllers\DocumentoController@update')->name('documentos.update');
    Route::resource('documentos', 'App\Http\Controllers\DocumentoController');
    //Route::GET('documentos','App\Http\Controllers\DocumentoController@index')->name('documentos.index');
    //Route::POST('documentos','App\Http\Controllers\DocumentoController@store')->name('documentos.store');
    //Route::POST('update-documento','App\Http\Controllers\DocumentoController@update')->name('documentos.update');
   //Route::GET('documentos','App\Http\Controllers\DocumentoController@show')->name('documentos.show');*/
});


//EMAIL
Route::group(['middleware' => 'auth'], function () {
    Route::POST('correo', 'App\Http\Controllers\EmailController@enviarEmail')->name('correo.enviar');
});









