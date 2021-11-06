<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AkomodasiController;
use App\Http\Controllers\Api\BeritaParawisataController;
use App\Http\Controllers\Api\DestinasiWisataController;
use App\Http\Controllers\Api\EkonomiKreatifController;
use App\Http\Controllers\Api\EventParawisataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// AKOMODASI
Route::get('/akomodasi', [AkomodasiController::class, 'getAkomodasi']);
Route::get('/akomodasi/jarak', [AkomodasiController::class, 'getAkomodasiSortByJarak']);
Route::get('/akomodasi/kategori', [AkomodasiController::class, 'getKategori']);
Route::get('/akomodasi/kategori/{slugkategoriakomodasi}', [AkomodasiController::class, 'getByKategori']);

Route::get('/akomodasi/{slugakomodasi}', [AkomodasiController::class, 'getDetailAkomodasi']);
Route::get('/akomodasi/{slugakomodasi}/review', [AkomodasiController::class, 'getReview']);

// DESTINASI
Route::get('/destinasi', [DestinasiWisataController::class, 'getDestinasiWisata']);
Route::get('/destinasi/jarak', [DestinasiWisataController::class, 'getDestinasiWisataSortByJarak']);
Route::get('/destinasi/kategori', [DestinasiWisataController::class, 'getKategori']);
Route::get('/destinasi/kategori/{slugkategori}', [DestinasiWisataController::class, 'getByKategori']);

Route::get('/destinasi/{slugkategori}', [DestinasiWisataController::class, 'getDetailDestinasiWisata']);
Route::get('/destinasi/{slugDestinasiWisata}/review', [DestinasiWisataController::class, 'getReview']);

// EVENT PARAWISATA
Route::get('/event-parawisata', [EventParawisataController::class, 'eventAllParawisata']);
Route::get('/event-parawisata/coming', [EventParawisataController::class, 'eventParawisataComing']);
Route::get('/event-parawisata/{slug_event_parawisata}', [EventParawisataController::class, 'getDetailParawisata']);


// EKONOMI KREATIF
Route::get('/ekonomi-kreatif', [EkonomiKreatifController::class, 'getEkonomiKreatif']);
Route::get('/ekonomi-kreatif/jarak', [EkonomiKreatifController::class, 'getEkonomiKreatifSortByJarak']);
Route::get('/ekonomi-kreatif/kategori', [EkonomiKreatifController::class, 'getKategori']);
Route::get('/ekonomi-kreatif/kategori/{slugkategoriekonomikreatif}', [EkonomiKreatifController::class, 'getByKategori']);

Route::get('/ekonomi-kreatif/{slugekonomikreatif}', [EkonomiKreatifController::class, 'getDetailEkonomiKreatif']);
Route::get('/ekonomi-kreatif/{slugekonomikreatif}/review', [EkonomiKreatifController::class, 'getReview']);


// BERITA PARAWISATA
Route::get('/berita-parawisata', [BeritaParawisataController::class, 'beritaAllParawisata']);
Route::get('/berita-parawisata/{slug_event_parawisata}', [BeritaParawisataController::class, 'getDetailBeritaParawisata']);
