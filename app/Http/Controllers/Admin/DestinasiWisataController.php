<?php

namespace App\Http\Controllers\Admin;

use App\Models\destinasi_wisata;
use Illuminate\Http\Request;
use App\Models\DestinasiWisata;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DestinasiWisataController extends Controller
{
    public function index()
    {
        $data['kategori'] = DB::table('kategori_wisata')->get();
        $data['destinasi_wisata'] = DB::table('destinasi_wisata')
                            ->join('kategori_wisata','destinasi_wisata.kategori_wisata_id','kategori_wisata.id')
                            ->select('destinasi_wisata.id as id_destinasi_wisata','destinasi_wisata.*','kategori_wisata.*')
                            ->orderBy("destinasi_wisata.nama_wisata", "asc")
                            ->get();
        return view('admin.destinasi_wisata.index',$data);
    }

    public function create(Request $r)
    {
        if($r->id == NULL)
        {
            $file_upload = $r->file("thumbnail");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/thumbnail", $file_name);

            $simpan = DB::table('destinasi_wisata')->insert([
                'kategori_wisata_id' => $r->kategori,
                'nama_wisata' => $r->destinasi_wisata,
                'kelas' => $r->kelas,
                'tipe' => $r->tipe,
                'harga' => $r->harga,
                'keterangan' => $r->keterangan,
                'lat' => $r->lat,
                'long' => $r->lng,
                'slug_destinasi_wisata' => str_replace('+', '-', urlencode($r->destinasi_wisata)),
                'thumbnail_destinasi_wisata' => $file_name,
            ]);
        }else{
            $datacek = DB::table('destinasi_wisata')->where('id', $r->id)->first();
            if($r->thumbnail != 'undefined') {
                $file_upload = $r->file("thumbnail");
                $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
                $file_location = $file_upload->storeAs("public/thumbnail", $file_name);
                Storage::delete(["public/thumbnail/".$datacek->thumbnail_destinasi_wisata]);

                $update = array(
                    'kategori_wisata_id' => $r->kategori,
                    'nama_wisata' => $r->destinasi_wisata,
                    'kelas' => $r->kelas,
                    'tipe' => $r->tipe,
                    'harga' => $r->harga,
                    'keterangan' => $r->keterangan,
                    'lat' => $r->lat,
                    'long' => $r->lng,
                    'slug_destinasi_wisata' => str_replace('+', '-', urlencode($r->destinasi_wisata)),
                    'thumbnail_destinasi_wisata' => $file_name,
                );
            }else{
                $update = array(
                    'kategori_wisata_id' => $r->kategori,
                    'nama_wisata' => $r->destinasi_wisata,
                    'kelas' => $r->kelas,
                    'tipe' => $r->tipe,
                    'harga' => $r->harga,
                    'keterangan' => $r->keterangan,
                    'lat' => $r->lat,
                    'long' => $r->lng,
                    'slug_destinasi_wisata' => str_replace('+', '-', urlencode($r->destinasi_wisata)),
                );
            }
            $simpan = DB::table('destinasi_wisata')->where('id', $r->id)->update($update);
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
        $data = DB::table('destinasi_wisata')
        ->join('kategori_wisata','destinasi_wisata.kategori_wisata_id','kategori_wisata.id')
        ->select('destinasi_wisata.id as id_destinasi_wisata','destinasi_wisata.*','kategori_wisata.*')
        ->where('destinasi_wisata.id',$r->id)
        ->first();
        return response()->json(['data' => $data]);
    }

    public function delete(Request $r)
    {
        $data = DB::table('destinasi_wisata')->where('id', $r->id)->first();
        Storage::delete(["public/thumbnail/".$data->thumbnail_destinasi_wisata]);
        $hapus = DestinasiWisata::findOrFail($r->id)->delete();
        if($hapus == TRUE)
        {
            return response()->json(['pesan' => "berhasil", "msg" => "kategori telah dihapus"]);
        }else{
            return response()->json(['pesan' => "error", "msg" => "kategori gagal dihapus"]);
        }
    }

    public function fasilitas(Request $r)
    {
        $data['fasilitas'] = DB::table('destinasi_wisata_fasilitas_destinasi_wisata')
        ->join('destinasi_wisata','destinasi_wisata.id','destinasi_wisata_fasilitas_destinasi_wisata.destinasi_wisata_id')
        ->join('fasilitas_destinasi_wisata','fasilitas_destinasi_wisata.id','destinasi_wisata_fasilitas_destinasi_wisata.fasilitas_destinasi_wisata_id')
        ->select('fasilitas_destinasi_wisata.*','destinasi_wisata_fasilitas_destinasi_wisata.id as id_fasilitas','destinasi_wisata.*')
        ->where('destinasi_wisata_fasilitas_destinasi_wisata.destinasi_wisata_id',$r->id)
        ->get();
        return view('admin.destinasi_wisata.fasilitas',$data);
    }
}
