<?php

namespace App\Http\Controllers\Api;

use App\Models\Akomodasi;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Models\FasilitasUmum;
use App\Models\EkonomiKreatif;
use App\Models\DestinasiWisata;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SearchController extends Controller
{
    //
    public function home(Request $request)
    {

        try {
            $q = $request->q ?? '';
            $limit = (int) ($request->limit ?? 5);

            $data = collect(DB::select("SELECT id, nama_akomodasi as nama, 'akomodasi' as table_name, SIMILARITY_STRING('".$q."', nama_akomodasi) as score FROM akomodasi  WHERE nama_akomodasi LIKE '%".$q."%'
                        UNION ALL
                        SELECT id, nama_fasilitas_umum as nama, 'fasilitas_umum' as table_name, SIMILARITY_STRING('".$q."', nama_fasilitas_umum) as score FROM fasilitas_umum WHERE nama_fasilitas_umum LIKE '%".$q."%'
                        UNION ALL
                        SELECT id, nama_wisata as nama, 'destinasi_wisata' as table_name, SIMILARITY_STRING('".$q."', nama_wisata) as score FROM destinasi_wisata WHERE nama_wisata LIKE '%".$q."%'
                        UNION ALL
                        SELECT id, nama_ekonomi_kreatif as nama, 'ekonomi_kreatif' as table_name, SIMILARITY_STRING('".$q."', nama_ekonomi_kreatif) as score FROM ekonomi_kreatif WHERE nama_ekonomi_kreatif LIKE '%".$q."%'

                        ORDER BY score DESC LIMIT ".$limit))
            ->groupBy("table_name")
            ->map(function($item, $key) {
                if($key == "akomodasi") {
                    // return $item;
                    $ids = [];
                    foreach ($item as $v) {
                        $ids[] = $v->id;
                    }

                    // return $ids;
                    return Akomodasi::whereIn('akomodasi.id', $ids)
                                    ->with(["kategori", "fasilitas", "fotovideo"])
                                    ->join("kategori_akomodasi", "kategori_akomodasi.id", '=', "akomodasi.kategori_akomodasi_id")
                                    ->select("akomodasi.*",
                                            "kategori_akomodasi.slug_kategori_akomodasi"
                                    )->get();
                } else if($key == "fasilitas_umum") {
                    // return $item;
                    $ids = [];
                    foreach ($item as $v) {
                        $ids[] = $v->id;
                    }

                    // return $ids;
                    return FasilitasUmum::whereIn('akomodasi.id', $ids)
                                        ->with(["fotovideo"])
                                        ->select("fasilitas_umum.*")
                                        ->get();
                } else if($key == "destinasi_wisata") {
                    // return $item;
                    $ids = [];
                    foreach ($item as $v) {
                        $ids[] = $v->id;
                    }

                    // return $ids;
                    return DestinasiWisata::with(["kategori", "fasilitas", "fotovideo"])
                                            ->join("kategori_wisata", "kategori_wisata.id", '=', "destinasi_wisata.kategori_wisata_id")
                                            ->whereIn('destinasi_wisata.id', $ids)
                                            ->select("destinasi_wisata.*", "kategori_wisata.slug_kategori_wisata")
                                            ->get();
                } else if($key == "ekonomi_kreatif") {
                    // return $item;
                    $ids = [];
                    foreach ($item as $v) {
                        $ids[] = $v->id;
                    }

                    // return $ids;

                    return EkonomiKreatif::whereIn('ekonomi_kreatif.id', $ids)->with(["kategori", "fotovideo"])
                    ->join("kategori_ekonomi_kreatif", "kategori_ekonomi_kreatif.id", '=', "ekonomi_kreatif.kategori_ekonomi_kreatif_id")
                    ->select("ekonomi_kreatif.*",
                            "kategori_ekonomi_kreatif.slug_kategori_kreatif"
                            )
                    ->get();

                }
            });

            return response()->json(ApiResponse::Ok($data, 200, "Oke"));
        } catch (ModelNotFoundException $e) {
            return response()->json(ApiResponse::NotFound("Data Tidak Ditemukan"));
        }
    }
}
