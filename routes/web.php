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
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
        // Kursus
        Route::get('kursus-gallery/{id}', 'Admin\KursusController@gallery')->name('kursus.gallery');
        Route::get('kursus_excel', 'Admin\KursusController@export_excel')->name('kursus.excel');
        Route::get('kursus_pdf', 'Admin\KursusController@export_pdf')->name('kursus.pdf');
        Route::resource('kursus', 'Admin\KursusController');
        // Kategori
        Route::resource('kategori', 'Admin\KategoriController')->except('show');
        // Komentar
        Route::get('komentar_excel', 'Admin\KomentarController@export_excel')
            ->name('komentar.excel');
        Route::get('komentar_pdf', 'Admin\KomentarController@export_pdf')
            ->name('komentar.pdf');
        Route::resource('komentar', 'Admin\KomentarController');

        // Gallery
        Route::resource('gallery', 'Admin\GalleryController');

        // Siswa Unit
        Route::get('unit_excel', 'Admin\UnitController@export_excel')->name('unit.excel');
        Route::get('unit_pdf', 'Admin\UnitController@export_pdf')->name('unit.pdf');
        Route::resource('unit', 'Admin\UnitController');
        Route::get('siswa-unit', 'Admin\SiswaUnitController@index')->name('siswa.unit');
        Route::get('siswa-unit/detail/{unit_id}', 'Admin\SiswaUnitController@detail_siswa')->name('siswa.unit.detail');
        Route::get('siswa-unit/{id}/confirm', 'Admin\SiswaUnitController@confirm')->name('siswa.unit.confirm');
        Route::get('siswa-unit/{id}/confirm_down', 'Admin\SiswaUnitController@confirm_down')->name('siswa.unit.confirm_down');

        // Konfirmasi Siswa
        Route::get('/konfirmasi-siswa', 'Admin\KonfirmasiSiswaController@index')
            ->name('siswa-konfirmasi.index');
        Route::get('/konfirmasi-siswa/{id}/detail', 'Admin\KonfirmasiSiswaController@detail')
            ->name('siswa-konfirmasi.detail');
        Route::put('/konfirmasi-siswa/{id}/confirm', 'Admin\KonfirmasiSiswaController@confirm')
            ->name('siswa-konfirmasi.confirm');
        Route::put('/konfirmasi-siswa/{id}/cancel', 'Admin\KonfirmasiSiswaController@cancel')
            ->name('siswa-konfirmasi.cancel');

        // Banner
        Route::resource('banner', 'Admin\BannerController')->only(['index', 'update']);

        // Pendaftar Unit
        Route::get('pendaftar/{id}/status', 'Admin\PendaftarUnitController@setStatus')
            ->name('pendaftar-unit.status');
        Route::get('/pendaftar/download/{file}', 'Admin\PendaftarUnitController@download')
            ->name('download');
        Route::get('pendaftar_unit_excel', 'Admin\PendaftarUnitController@export_excel')
            ->name('pendaftar-unit.excel');
        Route::get('pendaftar_unit_pdf', 'Admin\PendaftarUnitController@export_pdf')
            ->name('pendaftar-unit.pdf');
        Route::resource('pendaftar-unit', 'Admin\PendaftarUnitController');

        // Unit Kursus
        Route::get('unit-kursus-export/{id}', 'Admin\UnitKursusController@export_excel')
            ->name('unit-kursus.excel');
        Route::get('unit-kursus-pdf/{id}', 'Admin\UnitKursusController@export_pdf')
            ->name('unit-kursus.pdf');
        Route::get('unit-kursus', 'Admin\UnitKursusController@index')
            ->name('unit-kursus.index');
        Route::get('unit-kursus/{id}', 'Admin\UnitKursusController@detail')
            ->name('unit-kursus.detail');
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
        Route::post('/kursus/update/{kursus_id}', 'Unit\KursusController@create_materi')->name('unit.kursus.materi');
        Route::delete('/kursus/update/{materi_id}', 'Unit\KursusController@delete_materi')->name('unit.kursus.materi.delete');

        // fasilitas
        Route::get('/fasilitas', 'Unit\FasilitasController@index')->name('unit.fasilitas.home');
        Route::post('/fasilitas/tambah', 'Unit\FasilitasController@tambah_fasilitas')->name('unit.fasilitas.tambah');
        Route::delete('/fasilitas/hapus', 'Unit\FasilitasController@hapus_fasilitas')->name('unit.fasilitas.hapus');

        // mentor
        Route::get('/mentor/penempatan', 'Unit\MentorController@penempatan')->name('penempatan.index');
        Route::get('/mentor/penempatan/create', 'Unit\MentorController@create_penempatan')->name('penempatan.create');
        Route::post('/mentor/penempatan/create', 'Unit\MentorController@store_penempatan')->name('penempatan.store');
        Route::get('/mentor/penempatan/edit/{id}', 'Unit\MentorController@edit_penempatan')->name('penempatan.edit');
        Route::put('/mentor/penempatan/edit/{id}', 'Unit\MentorController@update_penempatan')->name('penempatan.update');
        Route::delete('/mentor/penempatan/hapus/{id}', 'Unit\MentorController@delete_penempatan')->name('penempatan.delete');
        Route::resource('mentor', 'Unit\MentorController');

        // galeri
        Route::get('/galeri', 'Unit\GaleriController@index')->name('unit.galeri.home');
        Route::post('/galeri/tambah', 'Unit\GaleriController@store')
            ->name('unit.galeri.tambah');
        Route::delete('/galeri/{id}', 'Unit\GaleriController@destroy')->name('unit.galeri.hapus');

        // siswa
        Route::get('/pendaftar/konfirmasi', 'Unit\SiswaController@konfirmasi_siswa')->name('unit.siswa.konfirmasi');
        Route::get('/pendaftar/konfirmasi/{id}', 'Unit\SiswaController@detail_siswa')->name('unit.siswa.detail');
        Route::put('/pendaftar/konfirmasi/{id}/update', 'Unit\SiswaController@update_konfirmasi')->name('unit.siswa.update');

        Route::get('/siswa/kelompok', 'Unit\SiswaController@index_kelompok')->name('unit.siswa.kelompok');
        Route::get('/siswa/kelompok/{id}', 'Unit\SiswaController@card_kelompok')->name('unit.siswa.kelompok.card');
        Route::put('/siswa/kelompok/{id}', 'Unit\SiswaController@edit_card_kelompok')->name('unit.siswa.kelompok.edit');
        Route::get('/siswa/private', 'Unit\SiswaController@index_private')->name('unit.siswa.private');
        Route::get('/siswa/private/{id}', 'Unit\SiswaController@card_private')->name('unit.siswa.private.card');
        Route::put('/siswa/private/{id}', 'Unit\SiswaController@edit_card_private')->name('unit.siswa.private.edit');
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

        Route::get('/sertifikat', 'Siswa\KursusController@sertifikat_index')->name('sertifikat.index');
        Route::put('/sertifikat/{id}', 'Siswa\KursusController@sertifikat_update')->name('sertifikat.update');
    });

Route::middleware('auth:siswa,unit,manager')->group(function () {
    Route::get('unit/materi/{filename}', 'Unit\KursusController@download_materi')->name('materi.download');
});

Route::middleware('auth:siswa,manager')->group(function () {
    Route::get('manager/sertifikat/{filename}', 'Admin\SiswaUnitController@download_sertifikat')->name('sertifikat.download');
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
Route::get('/daftar-unit/getAutocomplete', 'Web\UnitController@getAutocomplete')->name('unit.getAutocomplte');
Route::get('/daftar/unit', 'Web\UnitController@index')->name('unit.daftar');
Route::post('/unit/add', 'Web\UnitController@post')->name('unit.add');
