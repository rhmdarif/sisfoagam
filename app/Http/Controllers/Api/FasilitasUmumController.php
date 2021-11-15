<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FasilitasUmumController extends Controller
{
    //
    public function getFasilitasUmum()
    {
        try {
            $data = FasilitasUmum::with(["fotovideo"])
            ->select("fasilitas_umum.*")->paginate(16);
            if ($data->count() > 0) {
                $data->makeHidden('fasilitas_umum_id');
                return response()->json(ApiResponse::Ok($data, 200, "Ok"));
            } else {
                return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getDetailFasilitasUmum($slugfasilitas_umum = null)
    {
        try {
            $data = FasilitasUmum::with(["fotovideo"])->where("slug_fasilitas_umum", $slugfasilitas_umum)->first();

            if ($data != null) {
                $data->makeHidden('fasilitas_umum_id');
                return response()->json(ApiResponse::Ok($data, 200, "Ok"));
            } else {
                return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
            }

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
