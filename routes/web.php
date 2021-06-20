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

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'App\Http\Controllers'], function () {
    // Route::get('identitas', 'SettingController@identitas');

    //For executor
    Route::resource('executor', 'ExecutorController');
    Route::get('get_executors', 'ExecutorController@ajax')->name('get_executors');

    // For company
    Route::resource('perusahaan', 'CompanyController');

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

    // For pengurutan hasil lab
    Route::resource('pengurutan', 'PengurutanItemController');

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

    // For Patient Test
    Route::resource('patient_registration', 'PatientRegistrationController');
    Route::get('patient_registration/{patient_registration}/bayar', 'PatientRegistrationController@bayar')->name('patient_registration.bayar');
    Route::put('patient_registration/{patient_registration}/bayar-setor', 'PatientRegistrationController@bayar_setor')->name('patient_registration.bayar_stor');

    // For Patient Test
    Route::resource('patient_test', 'PatientTestController');
    Route::resource('patient_test_result', 'PatientResultTestController');

    // Ajax no pendaftaran
    Route::get('get_no_pendaftaran', 'PatientTestController@getNoPendaftaran');

    // For Print Report Patient
    Route::get('report/{patient_registration}/nota', 'ReportController@nota')->name('pdf.nota');
    Route::get('report/{patient_registration}/kwitansi', 'ReportController@kwitansi')->name('pdf.kwitansi');
    Route::get('report/{patient_registration}/hasil_lab', 'ReportController@hasil_lab')->name('pdf.hasil_lab');
    Route::get('generate_pdf','AdminController@pdf');

    // For transaksi
    Route::resource('transaksi','TransaksiController');
    Route::post('ajax_transaksi', 'TransaksiController@ajax');

    // For setting the web
    Route::resource('setting', 'SettingController');

    // For roles and user
    Route::resource('hak_akses', 'RoleController');
    Route::get('get_roles', 'RoleController@ajax');

    // For users data manage
	Route::resource('users', 'UserController', ['except' => ['show']]);
    Route::get('get_users', 'UserController@ajax');

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::get('map', function () {return view('pages.maps');})->name('map');
    Route::get('icons', function () {return view('pages.icons');})->name('icons');
    Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

