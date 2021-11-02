<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Akomodasi as ModelsAkomodasi;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class Akomodasi extends Controller
{
    public function get($slugkategori = null, $slugakomodasi = null)
    {
        try {
            if ($slugakomodasi) {
                $data = ModelsAkomodasi::with(["kategori", "fasilitas"])->where("slug_akomodasi", $slugakomodasi)->get();
            } else {
                $data = ModelsAkomodasi::with(["kategori", "fasilitas"])->get();
            }
            $data->makeHidden('kategori_akomodasi_id');
            return response()->json(ApiResponse::Ok($data, 200, "Ok"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
