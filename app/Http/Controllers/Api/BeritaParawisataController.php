<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BeritaParawisataController extends Controller
{
    //
    public function beritaAllParawisata()
    {
        try {
            $data = DB::table('berita_parawisata')->orderBy('id', 'desc')->get();

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $th) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getDetailBeritaParawisata($slug_berita_parawisata)
    {
        try {
            $data = DB::table('berita_parawisata')->where("slug_berita_parawisata", $slug_berita_parawisata)->orderByDesc('id')->first();
            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $th) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
