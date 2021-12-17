<?php

namespace App\Http\Controllers\Admin\Report;

use PDF;
use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use App\Http\Controllers\Controller;
use App\Models\DestinasiWisataVisitor;

class DestinasiWisataController extends Controller
{
    //
    public function index(Request $request)
    {
        $periode = $request->tahun ?? date('Y');
        $destinasi_wisata = DestinasiWisata::all();

        $data['status'] = true;
        $data['periode'] = $periode;

        foreach ($destinasi_wisata as $key => $value) {
            $detail['nama_wisata'] = $value->nama_wisata;

            $pengunjung = DestinasiWisataVisitor::where('destinasi_wisata_id', $value->id)->where('periode', 'like', $periode.'-%')->get();

            for ($i=0; $i < 12; $i++) {
                if($i < 9) {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-0'.($i+1).'-01')->first()->visitor ?? 0;
                } else {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-'.($i+1).'-01')->first()->visitor ?? 0;
                }
            }

            $data['data'][] = $detail;
        }

        return view('admin.report.destinasi_wisata.index', compact('data'));
    }

    public function download(Request $request)
    {
        $periode = $request->tahun ?? date('Y');
        $destinasi_wisata = DestinasiWisata::all();

        $periode = $periode;

        foreach ($destinasi_wisata as $key => $value) {
            $detail['nama_wisata'] = $value->nama_wisata;

            $pengunjung = DestinasiWisataVisitor::where('destinasi_wisata_id', $value->id)->where('periode', 'like', $periode.'-%')->get();

            for ($i=0; $i < 12; $i++) {
                if($i < 9) {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-0'.($i+1).'-01')->first()->visitor ?? 0;
                } else {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-'.($i+1).'-01')->first()->visitor ?? 0;
                }
            }

            $data['data'][] = $detail;
        }

        view()->share('data', $data);
        view()->share('periode', $periode);
        $pdf_doc = PDF::loadView('admin.report.destinasi_wisata.download', [$data, $periode]);
        $pdf_doc->setPaper('A4','landscape');

        return $pdf_doc->download('Report_DestinasiWisata_Th_'.$periode.'.pdf');
        // view('admin.destinasi_wisata.report', compact('visitors'));
    }
}
