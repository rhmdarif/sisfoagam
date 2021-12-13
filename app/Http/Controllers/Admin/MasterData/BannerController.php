<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Models\SettingMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function toClient($kategori)
    {
        $media = SettingMedia::where('code', $kategori)->first();
        if($media == null) {
            $file = "/images/breadcrumb/akomodasi.jpg";
            if($kategori == "akomodasi") {
                $file = "/images/breadcrumb/akomodasi.jpg";
            } else if($kategori == "destinasi_wisata") {
                $file = "/images/breadcrumb/wisata.jpg";
            } else if($kategori == "ekonomi_kreatif") {
                $file = "/images/breadcrumb/ekonomikreatif.jpg";
            } else if($kategori == "event") {
                $file = "/images/breadcrumb/event.jpg";
            } else if($kategori == "berita") {
                $file = "/images/breadcrumb/berita.jpg";
            } else if($kategori == "fasilitas_umum") {
                $file = "/images/breadcrumb/fasilitas.jpg";
            }
        } else {
            $file = $media->url;
        }
        return ['status' => true, 'url' => $file];
    }

    public function index($kategori)
    {
        $media = SettingMedia::where('code', $kategori)->first();
        if($media == null) {
            $file = "/images/breadcrumb/akomodasi.jpg";
            if($kategori == "akomodasi") {
                $file = "/images/breadcrumb/akomodasi.jpg";
            } else if($kategori == "destinasi_wisata") {
                $file = "/images/breadcrumb/wisata.jpg";
            } else if($kategori == "ekonomi_kreatif") {
                $file = "/images/breadcrumb/ekonomikreatif.jpg";
            } else if($kategori == "event") {
                $file = "/images/breadcrumb/event.jpg";
            } else if($kategori == "berita") {
                $file = "/images/breadcrumb/berita.jpg";
            } else if($kategori == "fasilitas_umum") {
                $file = "/images/breadcrumb/fasilitas.jpg";
            }
        } else {
            $file = $media->url;
        }
        return view('admin.master_data.banner.index', compact('file', 'kategori'));
    }

    public function change($kategori, Request $request)
    {
        if($request->hasFile('photo')) {
            $file_file = $request->file("photo");
            $file_location = $file_file->storeAs("public/banner", $kategori.'.'.$file_file->getClientOriginalExtension());
            SettingMedia::updateOrCreate(['code' => $kategori], ['url' => storage_url(substr($file_location, 7))]);
        }

        return back()->with('success', "Berhasil diubah");
    }
}
