<?php

namespace App\Http\Controllers\Admin;

use App\Models\Akomodasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

    public function add()
    {
        $data['kategori'] = DB::table('kategori_akomodasi')->get();
        $data['fasilitas'] = DB::table('fasilitas_akomodasi')->get();
        return view("admin.akomodasi.create",$data);
    }

    public function create(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'kategori' => 'required|exists:kategori_akomodasi,id',
            'akomodasi' => 'required|string',
            'kelas' => 'required|string',
            'tipe' => 'required|string',
            'harga' => 'required|string',
            'keterangan' => 'nullable|string',
            'lat' => 'nullable',
            'lng' => 'nullable',
            'thumbnail' => 'required_if:id,NULL|image'
        ]);

        if($validator->fails()) {
            return response()->json(['pesan' => $validator->errors()->first()]);
        }

        $harga = preg_replace("/[^0-9]/", '', $r->harga);

        // return $r;
        if($r->id == NULL)
        {
            if($r->has("thumbnail")) {
                $file_upload = $r->file("thumbnail");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/thumbnail", $file_name);
            }

            $simpan = DB::table('akomodasi')->insertGetId([
                'kategori_akomodasi_id' => $r->kategori,
                'nama_akomodasi' => $r->akomodasi,
                'kelas' => $r->kelas,
                'tipe' => $r->tipe,
                'harga' => $harga,
                'keterangan' => $r->keterangan,
                'lat' => $r->lat,
                'long' => $r->lng,
                'slug_akomodasi' => str_replace('+', '-', urlencode($r->akomodasi)),
                'thumbnail_akomodasi' => $file_name ?? "",
            ]);
        }else{
            $datacek = DB::table('akomodasi')->where('id', $r->id)->first();

            if($datacek != NULL) {
                if($r->has('thumbnail')) {
                    $file_upload = $r->file("thumbnail");
                    $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                    $file_location = $file_upload->storeAs("public/thumbnail", $file_name);
                    Storage::delete(["public/thumbnail/".$datacek->thumbnail_akomodasi]);

                    $update = array(
                        'kategori_akomodasi_id' => $r->kategori,
                        'nama_akomodasi' => $r->akomodasi,
                        'kelas' => $r->kelas,
                        'tipe' => $r->tipe,
                        'harga' => $harga,
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
                        'harga' => $harga,
                        'keterangan' => $r->keterangan,
                        'lat' => $r->lat,
                        'long' => $r->lng,
                        'slug_akomodasi' => str_replace('+', '-', urlencode($r->akomodasi)),
                    );
                }
                $simpan = DB::table('akomodasi')->where('id', $r->id)->update($update);
            }
        }
        if($simpan)
        {

            if(count($r->fasilitas)) {
                DB::table('akomodasi_fasilitas_akomodasi')->where('akomodasi_id', $r->id ?? $simpan)->delete();

                foreach ($r->fasilitas as $fasilitas) {
                    $data_fasilitas[] = ['akomodasi_id' => $r->id ?? $simpan, 'fasilitas_akomodasi_id' => $fasilitas];
                }

                DB::table('akomodasi_fasilitas_akomodasi')->insert($data_fasilitas);
            }

            if($r->ajax()) {
                return response()->json(['pesan' => 'berhasil']);
            } else {
                return back()->with("success", "berhasil");
            }
        }else{

            if($r->ajax()) {
                return response()->json(['pesan' => 'error']);
            } else {
                return back()->with("error", "error");
            }

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

    public function fasilitas_select2($id)
    {
        return DB::table('akomodasi_fasilitas_akomodasi')
                                        ->select("fasilitas_akomodasi.id", "fasilitas_akomodasi.nama_fasilitas_akomodasi as text")
                                        ->join("fasilitas_akomodasi", "fasilitas_akomodasi.id", "=", "akomodasi_fasilitas_akomodasi.fasilitas_akomodasi_id")
                                        ->where('akomodasi_id', $id)->get();
    }
    public function edit_page($id)
    {
        $data['data'] = DB::table('akomodasi')
        ->join('kategori_akomodasi','akomodasi.kategori_akomodasi_id','kategori_akomodasi.id')
        ->select('akomodasi.id as id_akomodasi','akomodasi.*','kategori_akomodasi.*')
        ->where('akomodasi.id', $id)
        ->first();

        // return $data;
        $data['kategori'] = DB::table('kategori_akomodasi')->get();
        $data['fasilitas'] = DB::table('fasilitas_akomodasi')->get();

        return view('admin.akomodasi.edit', $data);
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
