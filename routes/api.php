<?php

use App\Http\Controllers\API\Akomodasi;
use Illuminate\Support\Facades\Route;

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
Route::get('/akomodasi', [Akomodasi::class, 'getAkomodasi']);
Route::get('/akomodasi/kategori', [Akomodasi::class, 'getKategori']);
Route::get('/akomodasi/kategori/{slugkategoriakomodasi}', [Akomodasi::class, 'getByKategori']);

Route::get('/akomodasi/{slugakomodasi}', [Akomodasi::class, 'getDetailAkomodasi']);
Route::get('/akomodasi/{slugakomodasi}/review', [Akomodasi::class, 'getReview']);
