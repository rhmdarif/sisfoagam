<?php

namespace App\Http\Controllers\Api;

use App\Models\Akomodasi;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ReviewAkomodasi;
use App\Models\KategoriAkomodasi;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class AkomodasiController extends Controller
{
    public function getKategori()
    {
        try {
            $data = KategoriAkomodasi::all();
            return response()->json(ApiResponse::Ok($data, 200, "Oke"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getBykategori($slugkategori)
    {
        try {
            $data = Akomodasi::with(["kategori", "fasilitas", "fotovideo"])->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")->where("slug_kategori_akomodasi", $slugkategori)->select("akomodasi.*", "kategori_akomodasi.slug_kategori_akomodasi")->paginate(8);

            if ($data->count() > 0) {
                $data->makeHidden('kategori_akomodasi_id');
                return response()->json(ApiResponse::Ok($data, 200, "Ok"));
            } else {
                return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getAkomodasi()
    {
        $request = request();
        try {

            $data = Akomodasi::with(["kategori", "fasilitas", "fotovideo"])
            ->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")
            ->select("akomodasi.*",
                    "kategori_akomodasi.slug_kategori_akomodasi"
                    )->paginate(8);

            if ($data->count() > 0) {
                $data->makeHidden('kategori_akomodasi_id');
                return response()->json(ApiResponse::Ok($data, 200, "Ok"));
            } else {
                return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
    public function getDetailAkomodasi($slugakomodasi = null)
    {
        try {
            $data = Akomodasi::with(["kategori", "fasilitas", "fotovideo"])->where("slug_akomodasi", $slugakomodasi)->first();

            if ($data != null) {
                $data->makeHidden('kategori_akomodasi_id');
                return response()->json(ApiResponse::Ok($data, 200, "Ok"));
            } else {
                return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
            }

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getReview($slugakomodasi = null)
    {
        try {
            $data = ReviewAkomodasi::join("akomodasi", "akomodasi.id", "=", "review_akomodasi.akomodasi_id")
            ->join("users", "users.id", "=", "review_akomodasi.users_id")
            ->where("slug_akomodasi", $slugakomodasi)->select("review_akomodasi.id", "review_akomodasi.akomodasi_id", "review_akomodasi.tingkat_kepuasan", "review_akomodasi.komentar", "review_akomodasi.created_at", "users.name",)->get();

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
