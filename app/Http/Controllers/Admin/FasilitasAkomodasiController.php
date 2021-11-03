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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fasilitasAkomodasis = DB::table('fasilitas_akomodasi')->orderBy("nama_fasilitas_akomodasi", "asc")->paginate(10);
        return view('admin.fasilitas.index', compact('fasilitasAkomodasis'));
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
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required|string|unique:fasilitas_akomodasi,nama_fasilitas_akomodasi',
            'icon_fasilitas' => 'nullable|image',
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $file_upload = $request->file("icon_fasilitas");
        $file_location = $file_upload->storeAs("public/fasilitas_akomodasi", rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension());

        DB::table('fasilitas_akomodasi')->insert([
            'nama_fasilitas_akomodasi' => $request->nama_fasilitas,
            'icon_fasilitas_akomodasi' => $file_location,
        ]);
        return ["status" => true, "msg" => "Fasilitas telah ditambahkan"];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FasilitasAkomodasi  $fasilitasAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function show(FasilitasAkomodasi $fasilitasAkomodasi)
    {
        //
        return $fasilitasAkomodasi;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FasilitasAkomodasi  $fasilitasAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function edit(FasilitasAkomodasi $fasilitasAkomodasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FasilitasAkomodasi  $fasilitasAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FasilitasAkomodasi $fasilitasAkomodasi)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_fasilitas' => 'required|string|unique:fasilitas_akomodasi,nama_fasilitas_akomodasi,'.$fasilitasAkomodasi->id,
            'icon_fasilitas' => 'nullable|image',
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $update['nama_fasilitas_akomodasi'] = $request->nama_fasilitas;

        if($request->has("icon_fasilitas")) {
            $file_upload = $request->file("icon_fasilitas");
            $file_location = $file_upload->storeAs("public/fasilitas_akomodasi", rand(100,333)."-".time().".".$file_upload->getClientOriginalExtension());
            Storage::delete([$fasilitasAkomodasi->icon_fasilitas_akomodasi]);
            $update['icon_fasilitas_akomodasi'] = $file_location;
        }

        DB::table('fasilitas_akomodasi')->where('id', $fasilitasAkomodasi->id)->update($update);
        return ["status" => true, "msg" => "Fasilitas telah diperbaharui"];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasAkomodasi  $fasilitasAkomodasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(FasilitasAkomodasi $fasilitasAkomodasi)
    {
        //
        $fasilitasAkomodasi->delete();
        return ['status' => true, "msg" => "Fasilitas telah dihapus"];
    }
}
