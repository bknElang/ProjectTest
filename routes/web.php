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

//login
Route::get('/', 'App\Http\Controllers\AuthController@getLogin')->middleware('guest')->name('login');
Route::post('/', 'App\Http\Controllers\AuthController@postLogin')->middleware('guest');

//register
Route::get('/register', 'App\Http\Controllers\UserController@create')->middleware('guest')->name('register');
Route::post('/register', 'App\Http\Controllers\UserController@store')->middleware('guest');

//login redirect
Route::get('/home', 'App\Http\Controllers\PageController@loginCheck')->middleware('auth')->name('dashboard');

//logout
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth')->name('logout');

//perusahaan
Route::get('/perusahaan', 'App\Http\Controllers\PerusahaanController@index')->middleware('auth')->name('perusahaan');
Route::post('/perusahaan', 'App\Http\Controllers\PerusahaanController@store')->middleware('auth');
Route::get('/perusahaan/{perusahaan}', 'App\Http\Controllers\PerusahaanController@show')->middleware('auth')->name('Detail Perusahaan');
Route::post('/perusahaan/{perusahaan}', 'App\Http\Controllers\PerusahaanController@update')->middleware('auth');
Route::delete('/perusahaan/{perusahaan}', 'App\Http\Controllers\PerusahaanController@destroy')->middleware('auth');

//barang
Route::get('/barang', 'App\Http\Controllers\BarangController@index')->middleware('auth')->name('barang');
Route::post('/barang', 'App\Http\Controllers\BarangController@store')->middleware('auth');
Route::get('/barang/{barang}', 'App\Http\Controllers\BarangController@show')->middleware('auth')->name('Detail Barang');
Route::post('/barang/{barang}', 'App\Http\Controllers\BarangController@update')->middleware('auth');
Route::delete('/barang/{barang}', 'App\Http\Controllers\BarangController@destroy')->middleware('auth');

//transaksi
Route::get('/transaksi', 'App\Http\Controllers\TransaksiController@index')->middleware('auth')->name('perusahaan');
Route::post('/transaksi', 'App\Http\Controllers\TransaksiController@store')->middleware('auth');
Route::get('/transaksi/{transaksi}', 'App\Http\Controllers\TransaksiController@show')->middleware('auth')->name('Detail Barang');
Route::delete('/transaksi/{transaksi}', 'App\Http\Controllers\TransaksiController@destroy')->middleware('auth');

//report
Route::get('/barang/export/', 'App\Http\Controllers\BarangController@export');
Route::get('/perusahaan/export/', 'App\Http\Controllers\PerusahaanController@export');
Route::get('/transaksi/export/', 'App\Http\Controllers\TransaksiController@export');
Route::get('/users/export/', 'App\Http\Controllers\UserController@export');
