<?php

use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as("admin.")->group(function () {
    Route::get("login", [Admin\Auth\LoginController::class, 'index'])->name("login");
    Route::post("login", [Admin\Auth\LoginController::class, 'store']);

    Route::middleware(['auth'])->group(function () {
        Route::get('home', [Admin\HomeController::class, 'index'])->name('home');


        Route::resource('fasilitas-akomodasi', Admin\FasilitasAkomodasiController::class)->except(["create", "edit"]);
        // Route::prefix('fasilitas-akomodasi')->as("fasilitas-akomodasi.")->group(function () {
        //     Route::get('/', [Admin\FasilitasAkomodasiController::class, 'index'])->name("index");
        // });
    });
});
