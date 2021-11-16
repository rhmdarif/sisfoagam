<?php

namespace App\Http\Controllers\Admin\MasterData\DestinasiWisata;

use App\Http\Controllers\Controller;
use App\Models\FasilitasWisata;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view("admin.destinasi_wisata.fasilitas.index");
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FasilitasWisata  $fasilitasWisata
     * @return \Illuminate\Http\Response
     */
    public function show(FasilitasWisata $fasilitasWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FasilitasWisata  $fasilitasWisata
     * @return \Illuminate\Http\Response
     */
    public function edit(FasilitasWisata $fasilitasWisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FasilitasWisata  $fasilitasWisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FasilitasWisata $fasilitasWisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FasilitasWisata  $fasilitasWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(FasilitasWisata $fasilitasWisata)
    {
        //
    }
}
