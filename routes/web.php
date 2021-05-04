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
    return view('welcome');
});

Route::auth();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
    //For executor
    Route::resource('executor', 'App\Http\Controllers\ExecutorController');
    Route::get('get_executors', 'App\Http\Controllers\ExecutorController@ajax')->name('get_executors');

    //For item
    Route::resource('item', 'App\Http\Controllers\ItemController');
    Route::get('get_items', 'App\Http\Controllers\ItemController@ajax')->name('get_items');

    // For tipe hasil
    Route::resource('hasil_lab_tipe', 'App\Http\Controllers\HasilLabTipeController');
    Route::get('get_hsllab_tipe', 'App\Http\Controllers\HasilLabTipeController@ajax')->name('get_hsllab_tipe');

    // For hasil lab rinci
    Route::resource('hasil_lab_tiper', 'App\Http\Controllers\HasilLabTiperController');
    Route::get('get_hsllab_tiper', 'App\Http\Controllers\HasilLabTiperController@ajax')->name('get_hsllab_tiper');
    Route::get('get_hsllab_tiper/{id_tipe}', 'App\Http\Controllers\HasilLabTiperController@get_tiper');

    // For hasil lab
    Route::resource('hasil_lab', 'App\Http\Controllers\HasilLabController');
    Route::get('get_hsllab', 'App\Http\Controllers\HasilLabController@ajax');

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
    Route::get('map', function () {return view('pages.maps');})->name('map');
    Route::get('icons', function () {return view('pages.icons');})->name('icons');
    Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

