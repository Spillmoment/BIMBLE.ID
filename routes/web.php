<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Auth User
// Auth::routes();

// Auth Manager
Route::group(['prefix' => 'manager'], function () {

    // Route Auth
    Route::get('/login', 'AuthManager\LoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'AuthManager\LoginController@login')->name('manager.login.submit');
    Route::get('/logout', 'AuthManager\LoginController@logoutManager')->name('manager.logout');
    Route::get('/user/logout', 'Auth\LoginController@logoutUser')->name('user.logout');
    Route::get('/password/reset', 'AuthManager\ForgotPasswordController@showLinkRequestForm')->name('manager.password.request');
    Route::post('/password/email', 'AuthManager\ForgotPasswordController@sendResetLinkEmail')->name('manager.password.email');
    Route::get('/password/reset/{token}', 'AuthManager\ResetPasswordController@showResetForm')->name('manager.password.reset');
    Route::post('/password/reset', 'AuthManager\ResetPasswordController@reset');
});

// Auth Unit
Route::group(['prefix' => 'unit'], function () {
    Route::get('/login', 'AuthUnit\LoginController@showLoginForm')->name('unit.login');
    Route::post('/login', 'AuthUnit\LoginController@login')->name('unit.login.submit');

    Route::get('/logout', 'AuthUnit\LoginController@logoutUnit')->name('unit.logout');
    Route::get('/password/reset', 'AuthUnit\ForgotPasswordController@showLinkRequestForm')->name('unit.password.request');
    Route::post('/password/email', 'AuthUnit\ForgotPasswordController@sendResetLinkEmail')->name('unit.password.email');
    Route::get('/password/reset/{token}', 'AuthUnit\ResetPasswordController@showResetForm')->name('unit.password.reset');
    Route::post('/password/reset', 'AuthUnit\ResetPasswordController@reset');
});

Route::prefix('unit')
    ->middleware('auth:unit')
    ->group(function () {

        Route::get('/', 'Unit\DashboardController@index')->name('unit.home');
        Route::put('/profile/{id}/update', 'Unit\DashboardController@update_profile')->name('unit.update-profil');
        Route::put('/profile/{id}/update-banner', 'Unit\DashboardController@update_profile_banner')->name('unit.update-profil.banner');
        Route::put('/profile/{slug}/update-deskripsi', 'Unit\DashboardController@update_profile_deskripsi')->name('unit.update-profil.deskripsi');
        Route::get('/profile', 'Unit\DashboardController@profile')->name('unit.profile');
        Route::put('/pengaturan/{id}/update', 'Unit\DashboardController@update_pengaturan')->name('unit.update-pengaturan');
        Route::get('/pengaturan', 'Unit\DashboardController@pengaturan')->name('unit.pengaturan');

        // Pilih kursus
        Route::get('/kursus', 'Unit\KursusController@index')->name('unit.kursus.home');
        Route::post('/tambah_kursus', 'Unit\KursusController@tambah_kursus')->name('unit.kursus.tambah');
        Route::delete('/hapus_kursus', 'Unit\KursusController@hapus_kursus')->name('unit.kursus.hapus');
        Route::put('/harga_kursus', 'Unit\KursusController@harga_kursus')->name('unit.kursus.harga');

        // fasilitas
        Route::get('/fasilitas', 'Unit\FasilitasController@index')->name('unit.fasilitas.home');
        Route::post('/tambah_fasilitas', 'Unit\FasilitasController@tambah_fasilitas')->name('unit.fasilitas.tambah');
        Route::delete('/hapus_fasilitas', 'Unit\FasilitasController@hapus_fasilitas')->name('unit.fasilitas.hapus');

        // mentor
        Route::resource('mentor', 'Unit\MentorController');

        // galeri
        Route::get('/galeri', 'Unit\GaleriController@index')->name('unit.galeri.home');
        Route::post('/tambah_galeri_foto', 'Unit\GaleriController@store')->name('unit.galeri.tambah');
        Route::delete('/galeri/{id}', 'Unit\GaleriController@destroy')->name('unit.galeri.hapus');
    });

// Route Manager
Route::prefix('manager')
    ->middleware('auth:manager')
    ->group(function () {

        // Route Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('pendaftar/{id}/set-status', 'PendUnitController@setStatus')->name('pendaftar.status');

        Route::resources([
            'kursus' => 'KursusController',
            'unit'   => 'UnitController',
            'banner' => 'BannerController',
            'pendaftar' => 'PendUnitController',
            'komentar' => 'KomentarController',
        ]);
    });

// Route Front
Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/pusat_bantuan', 'Web\FrontController@pusat_bantuan')->name('front.pusat');
Route::get('/kursus', 'Web\FrontController@kursus')->name('front.kursus');
Route::get('/kursus_sort', 'Web\FrontController@kursusSort');
Route::get('/kursus/{slug}', 'Web\FrontController@show')->name('front.detail');
Route::get('/kursus/unit/{slug}', 'Web\UnitController@show')->name('unit.detail');
Route::get('/kursus/unit/{slug}/{slug_kursus}', 'Web\UnitController@show_kursus')->name('unit.detail.kursus');
Route::post('komentar/{id}/post', 'Web\KomentarController@post')->name('komentar.post');
Route::get('/unit/daftar', 'Web\UnitController@index')->name('unit.daftar');
Route::post('/unit/add', 'Web\UnitController@post')->name('unit.add');
