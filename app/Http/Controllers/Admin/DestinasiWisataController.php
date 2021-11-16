<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DestinasiWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinasiWisataController extends Controller
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
            'destinasi_wisata' => DestinasiWisata::with(['kategori' => function($kategori) {
                return $kategori->select("id","nama_kategori_wisata");
            }])->get()
        ];

        return view('admin.destinasi_wisata.index', $data);
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
            'fasilitas' => DB::table('fasilitas_wisata')->get(),
            'kategori' => DB::table('kategori_wisata')->get()
        ];

        return view('admin.destinasi_wisata.create', $data);
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
     * @param  \App\Models\DestinasiWisata  $destinasiWisata
     * @return \Illuminate\Http\Response
     */
    public function show(DestinasiWisata $destinasiWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DestinasiWisata  $destinasiWisata
     * @return \Illuminate\Http\Response
     */
    public function edit(DestinasiWisata $destinasiWisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DestinasiWisata  $destinasiWisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DestinasiWisata $destinasiWisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DestinasiWisata  $destinasiWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestinasiWisata $destinasiWisata)
    {
        //
    }
}
