<?php

namespace App\Http\Controllers\Admin\Report;

use PDF;
use App\Models\Akomodasi;
use Illuminate\Http\Request;
use App\Models\AkomodasiVisitor;
use App\Http\Controllers\Controller;

class AkomodasiController extends Controller
{
    //
    public function index(Request $request)
    {
        $periode = $request->tahun ?? date('Y');
        $akomodasi = Akomodasi::all();

        $data['status'] = true;
        $data['periode'] = $periode;

        foreach ($akomodasi as $key => $value) {
            $detail['nama_akomodasi'] = $value->nama_akomodasi;

            $pengunjung = AkomodasiVisitor::where('akomodasi_id', $value->id)->where('periode', 'like', $periode.'-%')->get();

            for ($i=0; $i < 12; $i++) {
                if($i < 9) {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-0'.($i+1).'-01')->first()->visitor ?? 0;
                } else {
                    $detail['data'][$i] = $pengunjung->where('periode', $periode.'-'.($i+1).'-01')->first()->visitor ?? 0;
                }
            }

            $data['data'][] = $detail;
        }

        return view('admin.report.akomodasi.index', compact('data'));
    }

    public function download(Request $request)
    {
        $periode = $request->tahun ?? date('Y');
        $akomodasi = Akomodasi::all();

        $periode = $periode;

        foreach ($akomodasi as $key => $value) {
            $detail['nama_akomodasi'] = $value->nama_akomodasi;

            $pengunjung = AkomodasiVisitor::where('akomodasi_id', $value->id)->where('periode', 'like', $periode.'-%')->get();

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
        $pdf_doc = PDF::loadView('admin.report.akomodasi.download', [$data, $periode]);
        $pdf_doc->setPaper('A4','landscape');

        return $pdf_doc->download('Report_Akomodasi_Th_'.$periode.'.pdf');
        // view('admin.akomodasi.report', compact('visitors'));
    }
}
