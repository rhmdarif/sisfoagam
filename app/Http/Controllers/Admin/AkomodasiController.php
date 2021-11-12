<?php

namespace App\Http\Controllers\Admin;

use App\Models\Akomodasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;

class AkomodasiController extends Controller
{
    public function index()
    {
        $data['kategori'] = DB::table('kategori_akomodasi')->get();
        $data['akomodasi'] = DB::table('akomodasi')
                            ->join('kategori_akomodasi','akomodasi.kategori_akomodasi_id','kategori_akomodasi.id')
                            ->select('akomodasi.id as id_akomodasi','akomodasi.*','kategori_akomodasi.*')
                            ->orderBy("akomodasi.nama_akomodasi", "asc")
                            ->get();
        return view('admin.akomodasi.index',$data);
    }

    public function create(Request $r)
    {
        if($r->id == NULL)
        {
            // $validator = Validator::make($request->all(), [
            //     'nama_kategori' => 'required|string|unique:kategori_akomodasi,nama_kategori_akomodasi',
            //     'icon_kategori' => 'nullable|image',
            // ]);
    
            // if($validator->fails()) {
            //     return ['status' => false, 'msg' => $validator->errors()->first()];
            // }

            $file_upload = $r->file("thumbnail");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/thumbnail", $file_name);
    
            $simpan = DB::table('akomodasi')->insert([
                'kategori_akomodasi_id' => $r->kategori,
                'nama_akomodasi' => $r->akomodasi,
                'kelas' => $r->kelas,
                'tipe' => $r->tipe,
                'harga' => $r->harga,
                'keterangan' => $r->keterangan,
                'lat' => $r->lat,
                'long' => $r->lng,
                'slug_akomodasi' => str_replace('+', '-', urlencode($r->akomodasi)),
                'thumbnail_akomodasi' => $file_name,
            ]);
        }else{
            $datacek = DB::table('akomodasi')->where('id', $r->id)->first();
            if($r->thumbnail != 'undefined') {
                $file_upload = $r->file("thumbnail");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/thumbnail", $file_name);
                Storage::delete(["public/thumbnail/".$datacek->thumbnail_akomodasi]);

                $update = array(
                    'kategori_akomodasi_id' => $r->kategori,
                    'nama_akomodasi' => $r->akomodasi,
                    'kelas' => $r->kelas,
                    'tipe' => $r->tipe,
                    'harga' => $r->harga,
                    'keterangan' => $r->keterangan,
                    'lat' => $r->lat,
                    'long' => $r->lng,
                    'slug_akomodasi' => str_replace('+', '-', urlencode($r->akomodasi)),
                    'thumbnail_akomodasi' => $file_name,
                );
            }else{
                $update = array(
                    'kategori_akomodasi_id' => $r->kategori,
                    'nama_akomodasi' => $r->akomodasi,
                    'kelas' => $r->kelas,
                    'tipe' => $r->tipe,
                    'harga' => $r->harga,
                    'keterangan' => $r->keterangan,
                    'lat' => $r->lat,
                    'long' => $r->lng,
                    'slug_akomodasi' => str_replace('+', '-', urlencode($r->akomodasi)),
                );
            }
            $simpan = DB::table('akomodasi')->where('id', $r->id)->update($update);
        }
        if($simpan == TRUE)
        {
            return response()->json(['pesan' => 'berhasil']);
        }else{
            return response()->json(['pesan' => 'error']);
        }
    }

    public function edit(Request $r)
    {
        $data = DB::table('akomodasi')
        ->join('kategori_akomodasi','akomodasi.kategori_akomodasi_id','kategori_akomodasi.id')
        ->select('akomodasi.id as id_akomodasi','akomodasi.*','kategori_akomodasi.*')
        ->where('akomodasi.id',$r->id)
        ->first();
        return response()->json(['data' => $data]);
    }

    public function delete(Request $r)
    {
        $data = DB::table('akomodasi')->where('id', $r->id)->first();
        Storage::delete(["public/thumbnail/".$data->thumbnail_akomodasi]);
        $hapus = Akomodasi::findOrFail($r->id)->delete();
        if($hapus == TRUE)
        {
            return response()->json(['pesan' => "berhasil", "msg" => "kategori telah dihapus"]);
        }else{
            return response()->json(['pesan' => "error", "msg" => "kategori gagal dihapus"]);
        }
    }

    public function fasilitas(Request $r)
    {
        $data['fasilitas'] = DB::table('akomodasi_fasilitas_akomodasi')
        ->join('akomodasi','akomodasi.id','akomodasi_fasilitas_akomodasi.akomodasi_id')
        ->join('fasilitas_akomodasi','fasilitas_akomodasi.id','akomodasi_fasilitas_akomodasi.fasilitas_akomodasi_id')
        ->select('fasilitas_akomodasi.*','akomodasi_fasilitas_akomodasi.id as id_fasilitas','akomodasi.*')
        ->where('akomodasi_fasilitas_akomodasi.akomodasi_id',$r->id)
        ->get();
        return view('admin.akomodasi.fasilitas',$data);
    }
}
