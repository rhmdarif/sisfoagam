<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    use HasFactory;
    protected $table = "destinasi_wisata";
    protected $appends = ['jarak'];


    public function getJarakAttribute()
    {
        $request = request();
        if($request->has('long') && $request->has('lat')) {
            return distance($request->lat, $request->long, $this->lat, $this->long);
        }

        return;
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriWisata::class, "kategori_wisata_id");
    }

    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasWisata::class);
    }

    public function fotovideo()
    {
        return $this->hasMany(DestinasiWisataFotoVidioWisata::class, "destinasi_wisata_id", "id");
    }
}
