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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function(){
    Route::get('/', 'InventoryController@index')->name('index');
    Route::delete('/', 'InventoryController@delete');
    Route::get('/edit/{id}', 'InventoryController@edit')->name('edit')->where('id', '[0-9]+');
    Route::post('/edit/{id}', 'InventoryController@editSave')->where('id', '[0-9]+');
    Route::get('/create', 'InventoryController@create')->name('create');
    Route::post('/create', 'InventoryController@createSave');
    Route::get('/pembelian/{id}', 'InventoryController@pembelian')->name('pembelian')->where('id', '[0-9]+');
    Route::post('/pembelian/{id}', 'InventoryController@pembelian')->where('id', '[0-9]+');
    Route::get('/penjualan/{id}', 'InventoryController@penjualan')->name('penjualan')->where('id', '[0-9]+');
    Route::post('/penjualan/{id}', 'InventoryController@penjualanSave')->where('id', '[0-9]+');
});

