<?php

namespace App\Http\Controllers\Api;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GaleryController extends Controller
{
    //
    public function index($kategori, $slug)
    {
        switch ($kategori) {
            case 'akomodasi':
                $t_foto_video = "foto_video_akomodasi";
                $t_kategori = "akomodasi";
                break;
            case 'ekonomi-kreatif':
                $t_foto_video = "foto_video_ekonomi_kreatif";
                $t_kategori = "ekonomi_kreatif";
                break;
            case 'fasilitas-umum':
                $t_foto_video = "foto_video_fasilitas_umum";
                $t_kategori = "fasilitas_umum";
                break;
            case 'destinasi':
                $t_foto_video = "destinasi_wisata_foto_vidio_wisata";
                $t_kategori = "destinasi_wisata";
                break;

            default:
                $t_foto_video = "foto_video_akomodasi";
                $t_kategori = "akomodasi";
                break;
        }
        $data = DB::table($t_foto_video)
                    ->select($t_foto_video.'.kategori', $t_foto_video.'.file')
                    ->join($t_kategori, $t_kategori.".id", $t_foto_video.".".$t_kategori."_id")
                    ->where($t_kategori.".slug_".$t_kategori, $slug)
                    ->get();
        return response()->json(ApiResponse::Ok($data, 200, "Ok"));
    }
}
