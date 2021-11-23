<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\EkonomiKreatif;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DestinasiWisataFotoVidioWisata;
use App\Models\KategoriEkonomiKreatif;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EkonomiKreatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'ekonomi_kreatif' => EkonomiKreatif::with(['kategori' => function($kategori) {
                return $kategori->select("id","nama_kategori_kreatif");
            }])->get()
        ];

        return view('admin.ekonomi_kreatif.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'kategori' => KategoriEkonomiKreatif::all()
        ];
        return view('admin.ekonomi_kreatif.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|exists:kategori_ekonomi_kreatif,id',
            'ekonomi_kreatif' => 'required|string|unique:ekonomi_kreatif,nama_ekonomi_kreatif',
            'harga' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'keterangan' => 'required|string',
            'thumbnail' => 'required|image',
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first())->withInput();
        }

        $harga  = preg_replace("/[^0-9]/", '', explode(",", $request->harga)[0]);


        if($request->has("thumbnail")) {
            $file_upload = $request->file("thumbnail");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/ekonomi_kreatif", $file_name);
        }

        $ekonomi_kreatif = EkonomiKreatif::create([
            'kategori_ekonomi_kreatif_id' => $request->kategori,
            'nama_ekonomi_kreatif' => $request->ekonomi_kreatif,
            'harga' => $harga,
            'lat' => $request->lat,
            'long' => $request->lng,
            'keterangan' => $request->keterangan,
            'slug_ekonomi_kreatif' => str_replace('+', '-', urlencode($request->ekonomi_kreatif)),
            'thumbnail_ekonomi_kreatif' => substr($file_location, 7)
        ]);

        if($request->hasfile('photos')) {
            $photos= [];
            foreach ($request->file('photos') as $key => $photo) {
                $name = $ekonomi_kreatif->id."-".$key."-".time().'.'.$photo->extension();
                // $photo->move(storage_path('app/public').'/akomodasi/', $name);
                $location = $photo->storeAs("public/foto_video_ekonomi_kreatif", $name);
                $mime = $photo->getMimeType();
                if(preg_match("/image/i", $mime)) {
                    $kategori = "foto";
                } else if(preg_match("/image/i", $mime)) {
                    $kategori = "video";
                }

                if(isset($kategori)) {
                    $photos[] = [
                        'ekonomi_kreatif_id' => $ekonomi_kreatif->id,
                        'kategori' => $kategori,
                        'file' => substr($location, 7)
                    ];
                }
            }
            DB::table('foto_video_ekonomi_kreatif')->insert($photos);
        }

        return back()->with("success", "Ekonomi Kreatif berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EkonomiKreatif  $ekonomi_kreatif
     * @return \Illuminate\Http\Response
     */
    public function show(EkonomiKreatif $ekonomi_kreatif)
    {
        //
        return $ekonomi_kreatif;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EkonomiKreatif  $ekonomi_kreatif
     * @return \Illuminate\Http\Response
     */
    public function edit(EkonomiKreatif $ekonomi_kreatif)
    {
        //
        $data = [
            'kategori' =>  KategoriEkonomiKreatif::all(),
            'ekonomi_kreatif' => $ekonomi_kreatif
        ];

        return view('admin.ekonomi_kreatif.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EkonomiKreatif  $ekonomi_kreatif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EkonomiKreatif $ekonomi_kreatif)
    {
        //
        $validator = Validator::make($request->all(), [
            'kategori' => 'required|exists:kategori_ekonomi_kreatif,id',
            'ekonomi_kreatif' => 'required|string|unique:ekonomi_kreatif,nama_ekonomi_kreatif,'.$ekonomi_kreatif->id,
            'harga' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
            'keterangan' => 'required|string',
            'thumbnail' => 'nullable|image',
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first())->withInput();
        }

        $harga  = preg_replace("/[^0-9]/", '', explode(",", $request->harga)[0]);

        $update = [
            'kategori_ekonomi_kreatif_id' => $request->kategori,
            'nama_ekonomi_kreatif' => $request->ekonomi_kreatif,
            'harga' => $harga,
            'lat' => $request->lat,
            'long' => $request->lng,
            'keterangan' => $request->keterangan,
            'slug_ekonomi_kreatif' => str_replace('+', '-', urlencode($request->ekonomi_kreatif))
        ];

        if($request->has("thumbnail")) {
            $file_upload = $request->file("thumbnail");
            $file_name = rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension();
            $file_location = $file_upload->storeAs("public/ekonomi_kreatif", $file_name);

            Storage::delete(["public/".$ekonomi_kreatif->thumbnail_ekonomi_kreatif]);

            $update['thumbnail_ekonomi_kreatif'] = substr($file_location, 7);
        }

        $ekonomi_kreatif->update($update);

        if($request->filled('old')) {
            $not_inc = DB::table('destinasi_wisata_foto_vidio_wisata')->where("destinasi_wisata_id", $ekonomi_kreatif->id)->whereNotIn("id", $request->old)->get();
            foreach ($not_inc as $key => $value) {
                Storage::delete(["public/".$value->file]);
            }

            DB::table('destinasi_wisata_foto_vidio_wisata')->where("destinasi_wisata_id", $ekonomi_kreatif->id)->whereNotIn("id", $request->old)->delete();
        }

        if($request->hasfile('photos')) {
            $photos= [];
            foreach ($request->file('photos') as $key => $photo) {
                $name = $ekonomi_kreatif->id."-".$key."-".time().'.'.$photo->extension();
                // $photo->move(storage_path('app/public').'/akomodasi/', $name);
                $location = $photo->storeAs("public/foto_video_ekonomi_kreatif", $name);
                $mime = $photo->getMimeType();
                if(preg_match("/image/i", $mime)) {
                    $kategori = "foto";
                } else if(preg_match("/image/i", $mime)) {
                    $kategori = "video";
                }

                if(isset($kategori)) {
                    $photos[] = [
                        'ekonomi_kreatif_id' => $ekonomi_kreatif->id,
                        'kategori' => $kategori,
                        'file' => substr($location, 7)
                    ];
                }
            }
            DB::table('foto_video_ekonomi_kreatif')->insert($photos);
        }

        return back()->with("success", "Ekonomi Kreatif berhasil ditambahkan");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EkonomiKreatif  $ekonomi_kreatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(EkonomiKreatif $ekonomi_kreatif)
    {
        //
        $ekonomi_kreatif->delete();
        return ['pesan' => 'berhasil'];
    }
}
