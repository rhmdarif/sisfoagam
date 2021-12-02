<?php

use App\Http\Controllers\Admin\AkomodasiController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("admin.auth.login");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/admin.php';

// Delete Detail Akomodasi
// Route::delete('{id}/detail/',[Admin\AkomodasiController::class, 'destroy'])->name('hapus.data_review_akomodasi');

