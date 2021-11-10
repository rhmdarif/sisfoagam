<?php

namespace App\Http\Controllers\Api;

use App\Models\Akomodasi;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //
    public function home(Request $request)
    {
        // if($request->has('q')) {
            $q = $request->q ?? '';
            $limit = (int) ($request->limit ?? 5);
            // $search = collect(DB::select("SELECT id, nama_akomodasi as nama, 'akomodasi' as table_name FROM akomodasi  WHERE nama_akomodasi LIKE '%".$q."%'
            // UNION ALL
            // SELECT id, nama_fasilitas_umum as nama, 'fasilitas_umum' as table_name FROM fasilitas_umum WHERE nama_fasilitas_umum LIKE '%".$q."%'
            // UNION ALL
            // SELECT id, nama_wisata as nama, 'destinasi_wisata' as table_name FROM destinasi_wisata WHERE nama_wisata LIKE '%".$q."%'
            // UNION ALL
            // SELECT id, nama_ekonomi_kreatif as nama, 'ekonomi_kreatif' as table_name FROM ekonomi_kreatif WHERE nama_ekonomi_kreatif LIKE '%".$q."%' LIMIT 3"));
            $search = collect(DB::select("SELECT id, nama_akomodasi as nama, 'akomodasi' as table_name, SIMILARITY_STRING('".$q."', nama_akomodasi) as score FROM akomodasi  WHERE nama_akomodasi LIKE '%".$q."%'
            UNION ALL
            SELECT id, nama_fasilitas_umum as nama, 'fasilitas_umum' as table_name, SIMILARITY_STRING('".$q."', nama_fasilitas_umum) as score FROM fasilitas_umum WHERE nama_fasilitas_umum LIKE '%".$q."%'
            UNION ALL
            SELECT id, nama_wisata as nama, 'destinasi_wisata' as table_name, SIMILARITY_STRING('".$q."', nama_wisata) as score FROM destinasi_wisata WHERE nama_wisata LIKE '%".$q."%'
            UNION ALL
            SELECT id, nama_ekonomi_kreatif as nama, 'ekonomi_kreatif' as table_name, SIMILARITY_STRING('".$q."', nama_ekonomi_kreatif) as score FROM ekonomi_kreatif WHERE nama_ekonomi_kreatif LIKE '%".$q."%'

            ORDER BY score DESC LIMIT ".$limit))->groupBy("table_name")->map(function($item, $key) {
                if($key == "akomodasi") {
                    // return $item;
                    return dd($item);
                    return Akomodasi::whereIn('id', $item->select('id'))
                                    ->with(["kategori", "fasilitas", "fotovideo"])
                                    ->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")
                                    ->select("akomodasi.*",
                                            "kategori_akomodasi.slug_kategori_akomodasi"
                                    )->get();
                }
            });

            // $search = DB::select(DB::raw("SELECT id, nama_akomodasi as nama, 'akomodasi' as table_name FROM akomodasi  WHERE nama_akomodasi LIKE 'Hotel%'
            // UNION ALL
            // SELECT id, nama_fasilitas_umum as nama, 'fasilitas_umum' as table_name FROM fasilitas_umum WHERE nama_fasilitas_umum LIKE 'Hotel%'
            // UNION ALL
            // SELECT id, nama_wisata as nama, 'destinasi_wisata' as table_name FROM destinasi_wisata WHERE nama_wisata LIKE 'Hotel%'
            // UNION ALL
            // SELECT id, nama_ekonomi_kreatif as nama, 'ekonomi_kreatif' as table_name FROM ekonomi_kreatif WHERE nama_ekonomi_kreatif LIKE 'Hotel%'"));


            // $search = DestinasiWisata::with(["kategori", "fasilitas", "fotovideo"])
            //                         ->join("kategori_wisata", "kategori_wisata.id", '=', "destinasi_wisata.kategori_wisata_id")
            //                         ->select("destinasi_wisata.*", "kategori_wisata.slug_kategori_wisata")
            //                         ->where("destinasi_wisata.nama_wisata", "like", "%".$q."%")
            //                         ->get();
            // $data = Akomodasi::with(["kategori", "fasilitas", "fotovideo"])
            //                 ->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")
            //                 ->select("akomodasi.*",
            //                         "kategori_akomodasi.slug_kategori_akomodasi"
            //                         )->paginate(8);

            return $search;
        // } else {
        //     return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        // }
    }
}
