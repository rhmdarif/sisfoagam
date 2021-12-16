<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriParawisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GaleriParawisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $galeries = GaleriParawisata::orderBy('id', 'desc')->paginate(10);
        return view('admin.galeri_parawisata.index', compact('galeries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin.galeri_parawisata.create");
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
            'thumbnail' => 'nullable|mimetypes:image/*',
            'kategori' => 'required|in:foto,video',
            'vidio_url' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        if($request->hasFile('thumbnail')) {
            $media = $request->file('thumbnail');
            $name = time().'-'.$media->getClientOriginalName().'.'.$media->getClientOriginalExtension();

            $location = $media->storeAs("public/galeri_parawisata", $name);
            $code = storage_url(substr($location, 7));
        }

        if($request->filled('vidio_url')) {
            $code = $request->vidio_url;
        }

        GaleriParawisata::create([
            'kategori' => $request->kategori,
            'file' => $code,
            'keterangan' => $request->keterangan ?? ""
        ]);

        return redirect()->route('admin.galeri-parawisata.index')->with("success", "Media berhasil diupload");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GaleriParawisata  $galeri_parawisatum
     * @return \Illuminate\Http\Response
     */
    public function show(GaleriParawisata $galeri_parawisatum)
    {
        //
        return $galeri_parawisatum;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GaleriParawisata  $galeri_parawisatum
     * @return \Illuminate\Http\Response
     */
    public function edit(GaleriParawisata $galeri_parawisatum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GaleriParawisata  $galeri_parawisatum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GaleriParawisata $galeri_parawisatum)
    {
        //
        // return $request->all();
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'nullable|mimetypes:image/*',
            'kategori' => 'required|in:foto,video',
            'vidio_url' => 'nullable|string',
            'keterangan' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $update = [
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan ?? ""
        ];

        if($request->hasFile('thumbnail')) {
            $media = $request->file('thumbnail');
            $name = time().'-'.$media->getClientOriginalName().'.'.$media->getClientOriginalExtension();

            $location = $media->storeAs("public/galeri_parawisata", $name);
            $code = storage_url(substr($location, 7));
        }

        if($request->filled('vidio_url')) {
            $code = $request->vidio_url;
        }

        $update['file'] = $code;
        $galeri_parawisatum->update($update);

        return redirect()->route('admin.galeri-parawisata.index')->with("success", "Media berhasil diupload");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GaleriParawisata  $galeri_parawisatum
     * @return \Illuminate\Http\Response
     */
    public function destroy(GaleriParawisata $galeri_parawisatum)
    {
        //
        $galeri_parawisatum->delete();
        return ['pesan' => 'berhasil'];
    }
}
