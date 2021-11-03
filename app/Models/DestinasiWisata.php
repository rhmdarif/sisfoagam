<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinasiWisata extends Model
{
    use HasFactory;
    protected $table = "destinasi_wisata";

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
