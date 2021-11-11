<?php

namespace App\Http\Controllers\Api;

use App\Models\Akomodasi;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ReviewAkomodasi;
use App\Models\KategoriAkomodasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getAkomodasiSortByJarak(Request $request)
    {
        if(!$request->has("lat") || !$request->has("long")) {
            return response()->json(ApiResponse::NotFound("Parameter required"));
        }

        try {
            $data = Akomodasi::with(["kategori", "fasilitas", "fotovideo"])
                            ->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")
                            ->select("akomodasi.*",
                                    "kategori_akomodasi.slug_kategori_akomodasi"
                                    // DB::raw("IFNULL(distance, 0) as distance")
                            )
                            ->orderByRaw("(
                                6371 * acos (
                                  cos ( radians(".$request->lat.") )
                                  * cos( radians( akomodasi.lat ) )
                                  * cos( radians( akomodasi.long ) - radians(".$request->long.") )
                                  + sin ( radians(".$request->lat.") )
                                  * sin( radians( akomodasi.lat ) )
                                )
                              )")
                            ->limit(5)->get();

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

    public function reviewAkomdasi(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:akomodasi,id',
            'rating' => 'required|numeric|min:0|max:5',
            'comment' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return response()->json(ApiResponse::Error(null, 200, $validator->errors()->first()));
        }

        ReviewAkomodasi::updateOrCreate([
            'akomodasi_id' => $request->id,
            'user_id' => $user->id
        ],[
            'tingkat_kepuasan' => $request->rating ?? 0,
            'komentar' => $request->comment ?? ""
        ]);

        return response()->json(ApiResponse::Ok(null, 200, "Rating telah diterapkan"));
    }
}
