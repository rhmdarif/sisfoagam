<?php

namespace App\Http\Controllers\API;

use App\Helper\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Akomodasi as ModelsAkomodasi;
use Illuminate\Http\Request;

class Akomodasi extends Controller
{
    public function get()
    {
        $data = ModelsAkomodasi::with(["kategori", "fasilitas"])->get();
        $data->makeHidden('kategori_akomodasi_id');
        return $data;

        return response()->json(ApiResponse::Ok($data, 200, "Ok"));
    }
}
