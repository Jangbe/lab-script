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

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], function () {
    //For executor
    Route::resource('executor', 'ExecutorController');
    Route::get('get_executors', 'ExecutorController@ajax')->name('get_executors');

    //For item
    Route::resource('item', 'ItemController');
    Route::get('get_items', 'ItemController@ajax')->name('get_items');

    // For tipe hasil
    Route::resource('hasil_lab_tipe', 'HasilLabTipeController');
    Route::get('get_hsllab_tipe', 'HasilLabTipeController@ajax')->name('get_hsllab_tipe');

    // For hasil lab rinci
    Route::resource('hasil_lab_tiper', 'HasilLabTiperController');
    Route::get('get_hsllab_tiper', 'HasilLabTiperController@ajax')->name('get_hsllab_tiper');
    Route::get('get_hsllab_tiper/{id_tipe}', 'HasilLabTiperController@get_tiper');

    // For hasil lab
    Route::resource('hasil_lab', 'HasilLabController');
    Route::get('get_hsllab', 'HasilLabController@ajax');

    // For item tarif
    Route::resource('item_tarif','ItemTarifController');
    Route::get('get_item_tarif', 'ItemTarifController@ajax');

    // For Alat Labs
    Route::resource('alat_lab', 'AlatLabController');

    // For Alat Lab Rinci
    Route::resource('alat_lab_rinci', 'AlatLabRinciController');

    // For Hasil Lab Alat
    Route::resource('hasil_lab_alat', 'HasilLabAlatController');

    // For Patient
    Route::resource('patient', 'PatientController');

	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade');
    Route::get('map', function () {return view('pages.maps');})->name('map');
    Route::get('icons', function () {return view('pages.icons');})->name('icons');
    Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

