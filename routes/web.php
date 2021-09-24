<?php

use Illuminate\Support\Facades\Route;


// Auth Manager
Route::group(['prefix' => 'manager'], function () {

    // Route Auth
    Route::get('/login', 'AuthManager\LoginController@showLoginForm')->name('manager.login');
    Route::post('/login', 'AuthManager\LoginController@login')->name('manager.login.submit');
    Route::get('/logout', 'AuthManager\LoginController@logoutManager')->name('manager.logout');
    Route::get('/user/logout', 'AuthManager\LoginController@logoutUser')->name('user.logout');
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

// Admin Manager
Route::prefix('manager')
    ->middleware('auth:manager')
    ->group(function () {

        // Route Dashboard
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/pendaftar/download/{file}', 'PendUnitController@download')->name('download');
        Route::get('pendaftar/{id}/status', 'PendUnitController@setStatus')->name('pendaftar-unit.status');
        Route::get('kursus-gallery/{id}', 'KursusController@gallery')->name('kursus.gallery');

        // Resource
        Route::resource('kategori', 'KategoriController')->except('show');
        Route::resource('pendaftar-unit', 'PendUnitController');
        Route::resources([
            'kursus' => 'KursusController',
            'unit'   => 'UnitController',
            'banner' => 'BannerController',
            'komentar' => 'KomentarController',
            'gallery' => 'GalleryController',
        ]);
    });


// Admin Unit
Route::prefix('unit')
    ->middleware('auth:unit')
    ->group(function () {

        Route::get('/', 'Unit\DashboardController@index')->name('unit.home');
        Route::put('/profile/{id}/update', 'Unit\DashboardController@update_profile')->name('unit.update-profil');
        Route::put('/profile/{id}/update-banner', 'Unit\DashboardController@update_profile_banner')->name('unit.update-profil.banner');
        Route::put('/profile/{slug}/update-lokasi', 'Unit\DashboardController@update_profile_lokasi')->name('unit.update-profil.lokasi');
        Route::put('/profile/{slug}/update-deskripsi', 'Unit\DashboardController@update_profile_deskripsi')->name('unit.update-profil.deskripsi');
        Route::get('/profile', 'Unit\DashboardController@profile')->name('unit.profile');
        Route::put('/pengaturan/{id}/update', 'Unit\DashboardController@update_pengaturan')->name('unit.update-pengaturan');
        Route::get('/pengaturan', 'Unit\DashboardController@pengaturan')->name('unit.pengaturan');

        // Pilih kursus
        Route::get('/kursus', 'Unit\KursusController@index')->name('unit.kursus.home');
        Route::post('/kursus/tambah', 'Unit\KursusController@tambah_kursus')->name('unit.kursus.tambah');
        Route::delete('/kursus/hapus', 'Unit\KursusController@hapus_kursus')->name('unit.kursus.hapus');
        Route::put('/kursus/harga', 'Unit\KursusController@harga_kursus')->name('unit.kursus.harga');

        // Detail Kursus
        Route::get('/kursus/detail/{slug}', 'Unit\KursusController@detail')->name('unit.kursus.detail');
        Route::get('/kursus/create/{id}', 'Unit\KursusController@tambah_detail')->name('unit.kursus.add');
        Route::put('/kursus/update/harga/{id}', 'Unit\KursusController@update_harga')->name('unit.kursus.update.harga');
        Route::put('/kursus/update/{id}', 'Unit\KursusController@detail_store')->name('unit.kursus.update');

        // fasilitas
        Route::get('/fasilitas', 'Unit\FasilitasController@index')->name('unit.fasilitas.home');
        Route::post('/fasilitas/tambah', 'Unit\FasilitasController@tambah_fasilitas')->name('unit.fasilitas.tambah');
        Route::delete('/fasilitas/hapus', 'Unit\FasilitasController@hapus_fasilitas')->name('unit.fasilitas.hapus');

        // mentor
        Route::resource('mentor', 'Unit\MentorController');

        // galeri
        Route::get('/galeri', 'Unit\GaleriController@index')->name('unit.galeri.home');
        Route::post('/galeri/tambah', 'Unit\GaleriController@store')->name('unit.galeri.tambah');
        Route::delete('/galeri/{id}', 'Unit\GaleriController@destroy')->name('unit.galeri.hapus');

        // nilai
        Route::get('/siswa/konfirmasi', 'Unit\SiswaController@konfirmasi_siswa')->name('unit.siswa.konfirmasi');
        Route::put('/siswa/konfirmasi', 'Unit\SiswaController@update_konfirmasi')->name('unit.konfirmasi.update');
        
        Route::get('/siswa/kelompok', 'Unit\SiswaController@index_kelompok')->name('unit.siswa.kelompok');
        Route::get('/siswa/private', 'Unit\SiswaController@index_private')->name('unit.siswa.private');
        Route::get('/siswa/{id}', 'Unit\SiswaController@kursus_siswa')->name('unit.siswa.kursus');
        Route::get('/siswa/{id}/create', 'Unit\SiswaController@create_siswa')->name('unit.siswa.create');
        Route::post('/siswa/{id}/create', 'Unit\SiswaController@store_siswa')->name('unit.siswa.store');
        Route::get('/siswa/{id}/edit/{id_siswa}', 'Unit\SiswaController@edit')->name('unit.siswa.edit');
        Route::put('/siswa/{id}/edit/{id_siswa}', 'Unit\SiswaController@update')->name('unit.siswa.update');
        Route::delete('/siswa/{id}', 'Unit\SiswaController@destroy')->name('unit.siswa.delete');
    });

// Auth Siswa
Route::group(['prefix' => 'siswa'], function () {
    Route::get('/register', 'AuthSiswa\RegisterController@registrationForm')->name('siswa.register');
    Route::post('/register', 'AuthSiswa\RegisterController@register')->name('siswa.register.post');

    Route::get('/login', 'AuthSiswa\LoginController@showLoginForm')->name('siswa.login');
    Route::post('/login', 'AuthSiswa\LoginController@login')->name('siswa.login.submit');

    Route::get('/logout', 'AuthSiswa\LoginController@logoutSiswa')->name('siswa.logout');
    Route::get('/password/reset', 'AuthSiswa\ForgotPasswordController@showLinkRequestForm')->name('siswa.password.request');
    Route::post('/password/email', 'AuthSiswa\ForgotPasswordController@sendResetLinkEmail')->name('siswa.password.email');
    Route::get('/password/reset/{token}', 'AuthSiswa\ResetPasswordController@showResetForm')->name('siswa.password.reset');
    Route::post('/password/reset', 'AuthSiswa\ResetPasswordController@reset');
});


// Route Web
Route::prefix('profile')
    ->middleware('auth:siswa')
    ->group(function () {
        Route::put('update/{id}/profile', 'Web\ProfileController@update_profile')->name('profile.update');
        Route::get('/', 'Web\ProfileController@profile')->name('profile.index');
        // Route::get('kursus', 'Web\ProfileController@kursus')->name('profile.kursus');
        Route::put('update/{id}/pengaturan', 'Web\ProfileController@update_pengaturan')
            ->name('pengaturan.update');
        Route::get('pengaturan', 'Web\ProfileController@pengaturan')->name('profile.pengaturan');
    });

Route::prefix('user')
    ->middleware('auth:siswa')
    ->group(function () {
        Route::post('/pesan_kursus/{kursus_unit_id}', 'Siswa\KursusController@pesan_kursus')->name('user.pesan');

        Route::get('/kursus', 'Siswa\KursusController@kursus')->name('user.kursus');
        Route::get('/materi/{kursus_unit_id}', 'Siswa\KursusController@materi')->name('user.materi');
    });

Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/pusat_bantuan', 'Web\FrontController@pusat_bantuan')->name('front.pusat');

Route::get('/', 'Web\FrontController@index')->name('front.index');
Route::get('/kursus', 'Web\FrontController@kursus')->name('front.kursus');

// Route::get('/kursus/search/', 'Web\FrontController@liveSearch')->name('search');
// Route::get('/kursus_sort', 'Web\FrontController@kursusSort');

Route::get('/kursus/{slug}/kelompok', 'Web\FrontController@show_kelompok')->name('front.detail.kelompok');
Route::get('/kursus/{slug}/private', 'Web\FrontController@show_private')->name('front.detail.private');
Route::get('/unit/{slug}', 'Web\UnitController@show')->name('unit.detail');
Route::get('/unit/{slug}/kursus/{slug_kursus}', 'Web\UnitController@show_kursus')->name('unit.detail.kursus');
Route::post('komentar/{id}/post', 'Web\KomentarController@post')->name('komentar.post');
Route::get('/daftar-unit', 'Web\UnitController@list')->name('unit.list');
Route::get('/daftar/unit', 'Web\UnitController@index')->name('unit.daftar');
Route::post('/unit/add', 'Web\UnitController@post')->name('unit.add');
