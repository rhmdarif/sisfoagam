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
});


Route::middleware(['auth'])->group(function () {
    Route::get('home', [Admin\HomeController::class, 'index'])->name('home');

    Route::prefix('kategori')->as('kategori.')->group(function () {
        Route::get('home', [Admin\KategoriAkomodasiController::class, 'index'])->name('home');
        Route::post('tambah', [Admin\KategoriAkomodasiController::class, 'create'])->name('tambah');
        Route::post('edit', [Admin\KategoriAkomodasiController::class, 'edit'])->name('edit');
        Route::post('update', [Admin\KategoriAkomodasiController::class, 'update'])->name('update');
        Route::post('delete', [Admin\KategoriAkomodasiController::class, 'delete'])->name('delete');
    });

    Route::prefix('fasilitas')->as('fasilitas.')->group(function () {
        Route::get('home', [Admin\FasilitasAkomodasiController::class, 'index'])->name('home');
        Route::post('tambah', [Admin\FasilitasAkomodasiController::class, 'create'])->name('tambah');
        Route::post('edit', [Admin\FasilitasAkomodasiController::class, 'edit'])->name('edit');
        Route::post('update', [Admin\FasilitasAkomodasiController::class, 'update'])->name('update');
        Route::post('delete', [Admin\FasilitasAkomodasiController::class, 'delete'])->name('delete');
    });
});
