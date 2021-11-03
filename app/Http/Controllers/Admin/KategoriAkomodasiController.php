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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategoriAkomodasis = DB::table('kategori_akomodasi')->orderBy("nama_kategori_akomodasi", "asc")->paginate(10);
        return view('admin.kategori.index', compact('kategoriAkomodasis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_kategori' => 'required|string|unique:kategori_akomodasi,nama_kategori_akomodasi',
            'icon_kategori' => 'nullable|image',
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $file_upload = $request->file("icon_kategori");
        $file_location = $file_upload->storeAs("public/kategori_akomodasi", rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension());

        DB::table('kategori_akomodasi')->insert([
            'nama_kategori_akomodasi' => $request->nama_kategori,
            'slug_kategori_akomodasi' => str_replace('+', '-', urlencode($request->nama_kategori)),
            'icon_kategori_akomodasi' => $file_location,
        ]);
        return ["status" => true, "msg" => "kategori telah ditambahkan"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KategoriAkomodasi  $kategoriAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function show(KategoriAkomodasi $kategoriAkomodasi)
    {
        //
        return $kategoriAkomodasi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KategoriAkomodasi  $kategoriAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriAkomodasi $kategoriAkomodasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KategoriAkomodasi  $kategoriAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KategoriAkomodasi $kategoriAkomodasi)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|unique:kategori_akomodasi,nama_kategori_akomodasi,'.$kategoriAkomodasi->id,
            'icon_kategori' => 'nullable|image',
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $update['nama_kategori_akomodasi'] = $request->nama_kategori;

        if($request->has("icon_kategori")) {
            $file_upload = $request->file("icon_kategori");
            $file_location = $file_upload->storeAs("public/kategori_akomodasi", rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension());
            Storage::delete([$kategoriAkomodasi->icon_kategori_akomodasi]);
            $update['icon_kategori_akomodasi'] = $file_location;
        }

        DB::table('kategori_akomodasi')->where('id', $kategoriAkomodasi->id)->update($update);
        return ["status" => true, "msg" => "kategori telah diperbaharui"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KategoriAkomodasi  $kategoriAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriAkomodasi $kategoriAkomodasi)
    {
        //
        $kategoriAkomodasi->delete();
        return ['status' => true, "msg" => "kategori telah dihapus"];
    }
}
