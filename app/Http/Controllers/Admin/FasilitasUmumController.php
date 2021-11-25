<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FasilitasUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FasilitasUmumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $fasilitas_umum = FasilitasUmum::all();
        return view('admin.fasilitas_umum.index', compact('fasilitas_umum'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.fasilitas_umum.create');
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
            'nama_fasilitas_umum' => 'required|string',
            'keterangan' => 'nullable|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        FasilitasUmum::updateOrCreate([
            'nama_fasilitas_umum' => $request->nama_fasilitas_umum,
            'lat' => $request->lat,
            'long' => $request->lng,
        ], [
            'keterangan' => $request->keterangan,
            'slug_fasilitas_umum' => str_replace('+', '-', urlencode($request->nama_fasilitas_umum))
        ]);

        return back()->with("success", "Fasilitas Umum berhasil ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FasilitasUmum  $fasilitas_umum
     * @return \Illuminate\Http\Response
     */
    public function show(FasilitasUmum $fasilitas_umum)
    {
        //
        return $fasilitas_umum;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FasilitasUmum  $fasilitas_umum
     * @return \Illuminate\Http\Response
     */
    public function edit(FasilitasUmum $fasilitas_umum)
    {
        //
        return view('admin.fasilitas_umum.edit', compact('fasilitas_umum'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FasilitasUmum  $fasilitas_umum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FasilitasUmum $fasilitas_umum)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_fasilitas_umum' => 'required|string',
            'keterangan' => 'nullable|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $fasilitas_umum->update([
            'nama_fasilitas_umum' => $request->nama_fasilitas_umum,
            'lat' => $request->lat,
            'long' => $request->lng,
            'keterangan' => $request->keterangan,
            'slug_fasilitas_umum' => str_replace('+', '-', urlencode($request->nama_fasilitas_umum))
        ]);

        return back()->with("success", "Fasilitas Umum berhasil diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasUmum  $fasilitas_umum
     * @return \Illuminate\Http\Response
     */
    public function destroy(FasilitasUmum $fasilitas_umum)
    {
        //
        $fasilitas_umum->delete();
        return ['pesan' => 'berhasil'];
    }
}
