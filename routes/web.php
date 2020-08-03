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
Auth::routes();

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

// Auth Tutor
Route::group(['prefix' => 'tutor'], function () {
    Route::get('/login', 'AuthTutor\LoginController@showLoginForm')->name('tutor.login');
    Route::post('/login', 'AuthTutor\LoginController@login')->name('tutor.login.submit');

    Route::get('/logout', 'AuthTutor\LoginController@logoutTutor')->name('tutor.logout');
    Route::get('/password/reset', 'AuthTutor\ForgotPasswordController@showLinkRequestForm')->name('tutor.password.request');
    Route::post('/password/email', 'AuthTutor\ForgotPasswordController@sendResetLinkEmail')->name('tutor.password.email');
    Route::get('/password/reset/{token}', 'AuthTutor\ResetPasswordController@showResetForm')->name('tutor.password.reset');
    Route::post('/password/reset', 'AuthTutor\ResetPasswordController@reset');
});

Route::prefix('tutor')
    ->middleware('auth:tutor')
    ->group(function () {

        Route::get('/', 'Tutor\DashboardController@index')->name('tutor.home');
        Route::put('/profile/{id}/update', 'Tutor\DashboardController@update_profile')->name('tutor.update-profil');
        Route::get('/profile', 'Tutor\DashboardController@profile')->name('tutor.profile');
        Route::put('/pengaturan/{id}/update', 'Tutor\DashboardController@update_pengaturan')->name('tutor.update-pengaturan');
        Route::get('/pengaturan', 'Tutor\DashboardController@pengaturan')->name('tutor.pengaturan');
        Route::put('siswa/nilai/{id}', 'Tutor\SiswaController@add_nilai')->name('siswa.add');
        Route::get('siswa/nilai/{id}/edit', 'Tutor\SiswaController@nilai')->name('siswa.nilai');
        Route::get('kursus/{slug}/nilai/', 'Tutor\NilaiController@kursus_nilai')->name('kursus.nilai');
        Route::resource('siswa', 'Tutor\SiswaController');
        Route::resource('nilai', 'Tutor\NilaiController');
        Route::get('kursus/nilai-kursus', 'Tutor\NilaiController@tutor_kursus')->name('tutor.kursus');
        Route::patch('nilai/{id}/edit', 'Tutor\NilaiController@edit_nilai_pendaftar');
    });

// Route Manager
Route::prefix('manager')
    ->middleware('auth:manager')
    ->group(function () {
        // Route Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        // Route Kursus
        Route::get('kursus/{id}/gallery', 'KursusController@gallery')->name('kursus.gallery');
        // Route Order
        Route::get('order/{id}/set-status', 'OrderController@setStatus')->name('order.status');

        Route::resources([
            'kategori'  => 'KategoriController',
            'kursus'    => 'KursusController',
            'gallery'   => 'GalleryController',
            'tutor'     => 'TutorController',
            'pendaftar' => 'PendaftarController',
            'order'     => 'OrderController'
        ]);
    });

// Route Front
Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/pusat_bantuan', 'Web\FrontController@pusat_bantuan')->name('front.pusat');
Route::get('/kursus', 'Web\FrontController@kursus')->name('front.kursus');
Route::get('/kursus_sort', 'Web\FrontController@kursusSort');
Route::get('/kursus/{slug}', 'Web\FrontController@show')->name('front.detail');
Route::get('/kursus/review/{slug}', 'Web\FrontController@review')->name('front.review');

// Route Profil
Route::group(['prefix' => 'profile'], function () {
    Route::put('update/{id}/profile', 'Web\ProfileController@update_profile')->name('profile.update');
    Route::get('/', 'Web\ProfileController@profile')->name('profile.index');
    Route::get('kursus', 'Web\ProfileController@kursus')->name('profile.kursus');
    Route::put('update/{id}/pengaturan', 'Web\ProfileController@update_pengaturan')->name('pengaturan.update');
    Route::get('pengaturan', 'Web\ProfileController@pengaturan')->name('profile.pengaturan');
});
// Route Order
Route::post('/order/post/{slug}', 'Web\OrderController@orderPost')->name('order.post');
Route::get('/order/success', 'Web\OrderController@success')->name('order.success');
Route::get('/order/cart', 'Web\OrderController@view')->name('order.view');
Route::get('/order/cart/pending', 'Web\OrderController@updateToPending')->name('order.update.cancel');
Route::delete('/order/cart/{id}', 'Web\OrderController@updateToDelete')->name('order.delete.pesanan');
Route::post('/order/cart/upload_bukti', 'Web\OrderController@uploadFile')->name('order.post.pembayaran');
Route::patch('/order/cart/upload_bukti', 'Web\OrderController@updateFile')->name('order.patch.pembayaran');
Route::patch('/order/checkout/{id}', 'Web\OrderController@deleteCheckout')->name('order.delete.checkout');

// Route Kursus
Route::get('/user/kursus-saya', 'Web\KursusUserController@kursus_success')->name('user.kursus.success');
Route::get('/user/kursus-review/{slug}', 'Web\KursusUserController@kursusKelas')->middleware('user.kursus')->name('user.kursus.kelas');
Route::post('/user/kursus/{slug}', 'Web\KursusUserController@kursusKelasKomentar')->name('user.kursus.komentar');
