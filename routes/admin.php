<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->as("admin.")->group(function () {
    Route::get("login", [Admin\Auth\LoginController::class, 'index'])->name("login");
    Route::post("login", [Admin\Auth\LoginController::class, 'store']);

    Route::get("daftar", [Admin\Auth\LoginController::class, 'daftar'])->name("daftar");
    Route::post("daftarkan", [Admin\Auth\LoginController::class, 'register'])->name("daftarkan");
    Route::get("logout", [Admin\Auth\LoginController::class, 'logout'])->name("logout");
    Route::middleware(['auth'])->group(function () {
        Route::get('home', [Admin\HomeController::class, 'index'])->name('home');
    });



    Route::middleware(['auth'])->group(function () {
        Route::get('/', function() {
            return redirect()->route("admin.home");
        });
        Route::get('home', [Admin\HomeController::class, 'index'])->name('home');


        Route::prefix('master-data')->as('master-data.')->group(function () {
            Route::prefix('kategori-akomodasi')->as('kategori-akomodasi.')->group(function () {
                Route::get('home', [Admin\KategoriAkomodasiController::class, 'index'])->name('home');
                Route::post('tambah', [Admin\KategoriAkomodasiController::class, 'create'])->name('tambah');
                Route::post('edit', [Admin\KategoriAkomodasiController::class, 'edit'])->name('edit');
                Route::post('update', [Admin\KategoriAkomodasiController::class, 'update'])->name('update');
                Route::post('delete', [Admin\KategoriAkomodasiController::class, 'delete'])->name('delete');
            });

            Route::prefix('fasilitas-akomodasi')->as('fasilitas-akomodasi.')->group(function () {
                Route::get('home', [Admin\FasilitasAkomodasiController::class, 'index'])->name('home');
                Route::post('tambah', [Admin\FasilitasAkomodasiController::class, 'create'])->name('tambah');
                Route::post('edit', [Admin\FasilitasAkomodasiController::class, 'edit'])->name('edit');
                Route::post('update', [Admin\FasilitasAkomodasiController::class, 'update'])->name('update');
                Route::post('delete', [Admin\FasilitasAkomodasiController::class, 'delete'])->name('delete');
            });
        });

        Route::prefix('akomodasi')->as('akomodasi.')->group(function (){
            Route::get('home', [Admin\AkomodasiController::class, 'index'])->name('home');
            Route::get('add', [Admin\AkomodasiController::class, 'add'])->name('add');
            Route::get('edit/{id}', [Admin\AkomodasiController::class, 'edit_page'])->name('edit-page');
            Route::post('tambah', [Admin\AkomodasiController::class, 'create'])->name('tambah');
            Route::post('edit', [Admin\AkomodasiController::class, 'edit'])->name('edit');
            Route::post('delete', [Admin\AkomodasiController::class, 'delete'])->name('delete');
            Route::post('fasilitas', [Admin\AkomodasiController::class, 'fasilitas'])->name('fasilitas');
            Route::get('fasilitas_select2/{id}', [Admin\AkomodasiController::class, 'fasilitas_select2'])->name('fasilitas_select2');
        });

        // Route::prefix('destinasi-wisata')->as('destinasi-wisata.')->group(function (){
        //     Route::get('home', [Admin\DestinasiWisataController::class, 'index'])->name('home');
        //     Route::post('tambah', [Admin\DestinasiWisataController::class, 'create'])->name('tambah');
        //     Route::post('edit', [Admin\DestinasiWisataController::class, 'edit'])->name('edit');
        //     Route::post('delete', [Admin\DestinasiWisataController::class, 'delete'])->name('delete');
        //     Route::post('fasilitas', [Admin\DestinasiWisataController::class, 'fasilitas'])->name('fasilitas');
        // });

        Route::resource('destinasi-wisata', Admin\DestinasiWisataController::class);
    });

    Route::prefix('select2')->as('select2.')->group(function () {
        Route::any('fasilitas-akomodasi', [Admin\FasilitasAkomodasiController::class, 'select2Fasilitas'])->name('fasilitas-akomodasi');
    });
});
