<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventParawisataController extends Controller
{
    //
    public function eventAllParawisata()
    {
        try {
            $data = DB::table('event_parawisata')->get();

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $th) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function getDetailParawisata($slug_event_parawisata)
    {
        try {
            $data = DB::table('event_parawisata')->where("slug_event_parawisata", $slug_event_parawisata)->orderByDesc('id')->first();
            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $th) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }

    public function eventParawisataComing()
    {
        try {
            $data = DB::table('event_parawisata')->where('start_at', '>=', date('Y-m-d'))->orderBy('start_at')->limit(5)->get();

            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $th) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
