<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FasilitasAkomodasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FasilitasAkomodasiController extends Controller
{
    public function index()
    {
        $data['fasilitasAkomodasis'] = DB::table('fasilitas_akomodasi')->orderBy("nama_fasilitas_akomodasi", "asc")->get();
        return view('admin.akomodasi.fasilitas.index', $data);
    }

    public function create(Request $request)
    {
        //
        if($request->id == NULL)
        {
            $validator = Validator::make($request->all(), [
                'nama_fasilitas' => 'required|string|unique:fasilitas_akomodasi,nama_fasilitas_akomodasi',
                'icon_fasilitas' => 'nullable|image',
            ]);

            if($validator->fails()) {
                return ['status' => false, 'msg' => $validator->errors()->first()];
            }

            $file_upload = $request->file("icon_fasilitas");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/fasilitas_akomodasi", $file_name);

            $simpan = DB::table('fasilitas_akomodasi')->insert([
                'nama_fasilitas_akomodasi' => $request->nama_fasilitas,
                'icon_fasilitas_akomodasi' => $file_name,
            ]);
        }else{
            $datacek = DB::table('fasilitas_akomodasi')->where('id', $request->id)->first();
            if($request->icon_fasilitas != 'undefined') {
                $file_upload = $request->file("icon_fasilitas");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/fasilitas_akomodasi", $file_name);
                Storage::delete(["public/fasilitas_akomodasi/".$datacek->icon_fasilitas_akomodasi]);

                $update = array(
                    'nama_fasilitas_akomodasi' => $request->nama_fasilitas,
                    'icon_fasilitas_akomodasi' => $file_name
                );
            }else{
                $update = array(
                    'nama_fasilitas_akomodasi' => $request->nama_fasilitas,
                );
            }
            $simpan = DB::table('fasilitas_akomodasi')->where('id', $request->id)->update($update);
        }

        if($simpan == TRUE)
        {
            return response()->json(['pesan' => 'berhasil']);
        }else{
            return response()->json(['pesan' => 'error']);
        }
    }

    public function edit(Request $request)
    {
        $dataFasilitas = DB::table('fasilitas_akomodasi')->where('id',$request->id)->first();
        return response()->json(['data' => $dataFasilitas]);
    }

    public function delete(Request $request)
    {
        $data = DB::table('fasilitas_akomodasi')->where('id', $request->id)->first();
        Storage::delete(["public/fasilitas_akomodasi/".$data->icon_fasilitas_akomodasi]);
        $hapus = FasilitasAkomodasi::findOrFail($request->id)->delete();
        if($hapus == TRUE)
        {
            return response()->json(['pesan' => true, "msg" => "kategori telah dihapus"]);
        }else{
            return response()->json(['pesan' => true, "msg" => "kategori gagal dihapus"]);
        }
    }
}
