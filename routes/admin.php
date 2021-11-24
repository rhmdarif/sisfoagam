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
            Route::prefix("akomodasi")->as("akomodasi.")->group(function () {
                Route::resource('kategori', Admin\MasterData\Akomodasi\KategoriController::class);
                Route::resource('fasilitas', Admin\MasterData\Akomodasi\FasilitasController::class);
            });

            Route::prefix("destinasi-wisata")->as("destinasi-wisata.")->group(function () {
                Route::resource('kategori', Admin\MasterData\DestinasiWisata\KategoriController::class);
                Route::resource('fasilitas', Admin\MasterData\DestinasiWisata\FasilitasController::class);
            });

            Route::prefix("ekonomi-kreatif")->as("ekonomi-kreatif.")->group(function () {
                Route::resource('kategori', Admin\MasterData\EkonomiKreatif\KategoriController::class);
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
            Route::get('{id}/fasilitas', [Admin\AkomodasiController::class, 'fasilitas_select2'])->name('fasilitas_select2');
            Route::get('{id}/media', [Admin\AkomodasiController::class, 'media'])->name('media');
        });

        // Route::prefix('destinasi-wisata')->as('destinasi-wisata.')->group(function (){
        //     Route::get('home', [Admin\DestinasiWisataController::class, 'index'])->name('home');
        //     Route::post('tambah', [Admin\DestinasiWisataController::class, 'create'])->name('tambah');
        //     Route::post('edit', [Admin\DestinasiWisataController::class, 'edit'])->name('edit');
        //     Route::post('delete', [Admin\DestinasiWisataController::class, 'delete'])->name('delete');
        //     Route::post('fasilitas', [Admin\DestinasiWisataController::class, 'fasilitas'])->name('fasilitas');
        // });


        // EKONOMI KREATIF
        Route::get('ekonomi-kreatif/{id}/fasilitas', [Admin\EkonomiKreatifController::class, 'fasilitas_select2'])->name('ekonomi-kreatif.fasilitas_select2');
        Route::get('ekonomi-kreatif/{id}/media', [Admin\EkonomiKreatifController::class, 'media'])->name('ekonomi-kreatif.media');
        Route::resource('ekonomi-kreatif', Admin\EkonomiKreatifController::class);

        // DESTINASI WISATA
        Route::get('destinasi-wisata/{id}/fasilitas', [Admin\DestinasiWisataController::class, 'fasilitas_select2'])->name('destinasi-wisata.fasilitas_select2');
        Route::get('destinasi-wisata/{id}/media', [Admin\DestinasiWisataController::class, 'media'])->name('destinasi-wisata.media');
        Route::resource('destinasi-wisata', Admin\DestinasiWisataController::class);

        // BERITA PARAWISATA
        Route::resource('berita-parawisata', Admin\BeritaParawisataController::class);

        // GALERY PARAWISATA
        Route::resource('galeri-parawisata', Admin\GaleriParawisataController::class);

        // EVENT PARAWISATA
        Route::resource('event-parawisata', Admin\EventParawisataController::class);

        // FASILITAS UMUM
        Route::resource('fasilitas-umum', Admin\FasilitasUmumController::class);
    });

    Route::prefix('select2')->as('select2.')->group(function () {
        Route::any('fasilitas-akomodasi', [Admin\FasilitasAkomodasiController::class, 'select2Fasilitas'])->name('fasilitas-akomodasi');
        Route::any('fasilitas-wisata', [Admin\MasterData\DestinasiWisata\FasilitasController::class, 'select2'])->name('fasilitas-wisata');

        Route::any('kategori-akomodasi', [Admin\MasterData\Akomodasi\KategoriController::class, 'select2'])->name('kategori-akomodasi');
        Route::any('kategori-wisata', [Admin\MasterData\DestinasiWisata\KategoriController::class, 'select2'])->name('kategori-wisata');
        Route::any('kategori-ekonomi', [Admin\MasterData\EkonomiKreatif\KategoriController::class, 'select2'])->name('kategori-ekonomi');
    });
});
