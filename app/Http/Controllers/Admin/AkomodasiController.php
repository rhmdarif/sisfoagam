<?php

namespace App\Http\Controllers\Admin;

use App\Models\Akomodasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FotoVideoAkomodasi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AkomodasiController extends Controller
{
    public function index()
    {
        $data['kategori'] = DB::table('kategori_akomodasi')->get();
        // $data['akomodasi'] = DB::table('akomodasi')
        //                     ->join('kategori_akomodasi','akomodasi.kategori_akomodasi_id','kategori_akomodasi.id')
        //                     ->select('akomodasi.id as id_akomodasi','akomodasi.*','kategori_akomodasi.*')
        //                     ->orderBy("akomodasi.nama_akomodasi", "asc")
        //                     ->get();
        $data['akomodasi'] = Akomodasi::orderBy("akomodasi.nama_akomodasi", "asc")->get();
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
            'thumbnail' => 'required_if:id,NULL|image',
            'photos.*' => 'image'
        ]);

        if($validator->fails()) {
            return response()->json(['pesan' => $validator->errors()->first()]);
        }
        list($harga) = explode(",", $r->harga);
        $harga = preg_replace("/[^0-9]/", '', $harga);

        // return $r;
        if($r->id == NULL)
        {
            if($r->has("thumbnail")) {
                $file_upload = $r->file("thumbnail");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/akomodasi", $file_name);
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
                'thumbnail_akomodasi' => storage_url(substr($file_location, 7)),
            ]);

            if($r->hasfile('photos')) {
                $photos= [];
                foreach ($r->file('photos') as $key => $photo) {
                    $name = $simpan."-".$key."-".time().'.'.$photo->extension();
                    // $photo->move(storage_path('app/public').'/akomodasi/', $name);
                    $photo->storeAs("public/foto_video_akomodasi", $name);
                    $mime = $photo->getMimeType();
                    if(preg_match("/image/i", $mime)) {
                        $kategori = "foto";
                    } else if(preg_match("/image/i", $mime)) {
                        $kategori = "video";
                    }

                    if(isset($kategori)) {
                        $photos[] = [
                            'akomodasi_id' => $simpan,
                            'kategori' => $kategori,
                            'file' => $name
                        ];
                    }
                }
                DB::table('foto_video_akomodasi')->insert($photos);
            }

        }else{
            $datacek = DB::table('akomodasi')->where('id', $r->id)->first();

            if($datacek != NULL) {
                if($r->has('thumbnail')) {
                    $file_upload = $r->file("thumbnail");
                    $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                    $file_location = $file_upload->storeAs("public/thumbnail", $file_name);

                    list($baseUrl, $path, $dir, $file) = explode("/", $datacek->thumbnail_akomodasi);
                    Storage::disk('public')->delete(implode('/', [$dir, $file]));

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
                        'thumbnail_akomodasi' => storage_url(substr($file_location, 7)),
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

                if($r->filled('old')) {
                    $not_inc = DB::table('foto_video_akomodasi')->where("akomodasi_id", $r->id)->whereNotIn("id", $r->old)->get();
                    foreach ($not_inc as $key => $value) {
                        list($baseUrl, $path, $dir, $file) = explode("/", $value->file);
                        Storage::disk('public')->delete(implode('/', [$dir, $file]));
                    }
                    DB::table('foto_video_akomodasi')->where("akomodasi_id", $r->id)->whereNotIn("id", $r->old)->delete();
                }

                if($r->hasfile('photos')) {
                    $photos= [];
                    foreach ($r->file('photos') as $key => $photo) {
                        $name = $simpan."-".$key."-".time().'.'.$photo->extension();
                        // $photo->move(storage_path('app/public').'/akomodasi/', $name);
                        $photo->storeAs("public/foto_video_akomodasi", $name);
                        $mime = $photo->getMimeType();
                        if(preg_match("/image/i", $mime)) {
                            $kategori = "foto";
                        } else if(preg_match("/image/i", $mime)) {
                            $kategori = "video";
                        }

                        if(isset($kategori)) {
                            $photos[] = [
                                'akomodasi_id' => $r->id,
                                'kategori' => $kategori,
                                'file' => $name
                            ];
                        }
                    }
                    DB::table('foto_video_akomodasi')->insert($photos);
                }

            }
        }


        if($r->filled("fasilitas") AND count($r->fasilitas)) {
            DB::table('akomodasi_fasilitas_akomodasi')->where('akomodasi_id', $r->id ?? $simpan)->delete();

            foreach ($r->fasilitas as $fasilitas) {
                $data_fasilitas[] = ['akomodasi_id' => $r->id ?? $simpan, 'fasilitas_akomodasi_id' => $fasilitas];
            }

            DB::table('akomodasi_fasilitas_akomodasi')->insert($data_fasilitas);
        }

        if($simpan)
        {

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
        $data['data'] = Akomodasi::find($id);

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

    public function media($id)
    {
        return FotoVideoAkomodasi::where('akomodasi_id', $id)->get();
    }

    public function detail($id)
    {
        $data['kategori'] = DB::table('kategori_akomodasi')->get();
        $data['akomodasi'] = DB::table('akomodasi')
                            ->join('kategori_akomodasi','akomodasi.kategori_akomodasi_id','kategori_akomodasi.id')
                            ->select('akomodasi.id as id_akomodasi','akomodasi.*','kategori_akomodasi.*')
                            ->where('akomodasi.id',$id)
                            ->orderBy("akomodasi.nama_akomodasi", "asc")
                            ->get();

        $data['review_a'] = DB::table('review_akomodasi')
                            ->join('akomodasi','review_akomodasi.akomodasi_id','akomodasi.id')
                            ->join('users','review_akomodasi.users_id','users.id')
                            ->where('review_akomodasi.akomodasi_id',$id)
                            ->orderBy('review_akomodasi.users_id',"asc")
                            ->SimplePaginate(5);
        
                      

        return view('admin.akomodasi.detail',$data);

       
    }

    public function hapus_detail($id)
    {
        DB::table('review_akomodasi')->where('id',$id)->delete();
        return response()->json(['success'=>'200']);
    }

}
