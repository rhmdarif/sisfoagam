<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\KategoriAkomodasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KategoriAkomodasiController extends Controller
{

    public function index()
    {
        //
        $kategoriAkomodasis = DB::table('kategori_akomodasi')->orderBy("nama_kategori_akomodasi", "asc")->paginate(10);
        return view('admin.akomodasi.kategori.index', compact('kategoriAkomodasis'));
    }

    public function create(Request $request)
    {
        if($request->id == NULL)
        {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required|string|unique:kategori_akomodasi,nama_kategori_akomodasi',
                'icon_kategori' => 'nullable|image',
            ]);

            if($validator->fails()) {
                return ['status' => false, 'msg' => $validator->errors()->first()];
            }

            $file_upload = $request->file("icon_kategori");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/kategori_akomodasi", $file_name);

            $simpan = DB::table('kategori_akomodasi')->insert([
                'nama_kategori_akomodasi' => $request->nama_kategori,
                'slug_kategori_akomodasi' => str_replace('+', '-', urlencode($request->nama_kategori)),
                'icon_kategori_akomodasi' => $file_name,
            ]);
        }else{
            $datacek = DB::table('kategori_akomodasi')->where('id', $request->id)->first();
            if($request->icon_kategori != 'undefined') {
                $file_upload = $request->file("icon_kategori");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/kategori_akomodasi", $file_name);
                Storage::delete(["public/kategori_akomodasi/".$datacek->icon_kategori_akomodasi]);

                $update = array(
                    'nama_kategori_akomodasi' => $request->nama_kategori,
                    'slug_kategori_akomodasi' => str_replace('+', '-', urlencode($request->nama_kategori)),
                    'icon_kategori_akomodasi' => $file_name
                );
            }else{
                $update = array(
                    'nama_kategori_akomodasi' => $request->nama_kategori,
                    'slug_kategori_akomodasi' => str_replace('+', '-', urlencode($request->nama_kategori)),
                );
            }
            $simpan = DB::table('kategori_akomodasi')->where('id', $request->id)->update($update);
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
        $dataKategori = DB::table('kategori_akomodasi')->where('id',$request->id)->first();
        return response()->json(['data' => $dataKategori]);
    }

    public function delete(Request $request)
    {
        $data = DB::table('kategori_akomodasi')->where('id', $request->id)->first();
        Storage::delete(["public/kategori_akomodasi/".$data->icon_kategori_akomodasi]);
        $hapus = KategoriAkomodasi::findOrFail($request->id)->delete();
        if($hapus == TRUE)
        {
            return response()->json(['pesan' => true, "msg" => "kategori telah dihapus"]);
        }else{
            return response()->json(['pesan' => true, "msg" => "kategori gagal dihapus"]);
        }
    }
}
