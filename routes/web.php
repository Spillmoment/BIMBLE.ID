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
        Route::get('/profile', 'Unit\DashboardController@profile')->name('unit.profile');
        Route::put('/pengaturan/{id}/update', 'Unit\DashboardController@update_pengaturan')->name('unit.update-pengaturan');
        Route::get('/pengaturan', 'Unit\DashboardController@pengaturan')->name('unit.pengaturan');
    });

// Route Manager
Route::prefix('manager')
    ->middleware('auth:manager')
    ->group(function () {

        // Route Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

        Route::resources([
            'kursus'    => 'KursusController',
            'unit'     => 'UnitController',
        ]);
    });

// Route Front
Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/pusat_bantuan', 'Web\FrontController@pusat_bantuan')->name('front.pusat');
Route::get('/kursus', 'Web\FrontController@kursus')->name('front.kursus');
Route::get('/kursus_sort', 'Web\FrontController@kursusSort');
Route::get('/kursus/{slug}', 'Web\FrontController@show')->name('front.detail');
Route::get('/kursus/unit/{slug}', 'Web\UnitController@show')->name('unit.detail');
Route::get('/unit', 'Web\UnitController@index')->name('unit.home');
Route::post('/unit', 'Web\UnitController@post')->name('unit.add');
