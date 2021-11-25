<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DestinasiWisata extends Model
{
    use HasFactory;
    protected $table = "destinasi_wisata";
    protected $fillable = [
                            'kategori_wisata_id',
                            'nama_wisata',
                            'harga_tiket_dewasa',
                            'harga_tiket_anak',
                            'biaya_parkir_roda_2',
                            'biaya_parkir_roda_4',
                            'lat',
                            'long',
                            'slug_destinasi',
                            'keterangan',
                            'thumbnail_destinasi_wisata'
                        ];
    protected $appends = ['jarak', 'rating'];

    public function getJarakAttribute()
    {
        $request = request();
        if($request->has('long') && $request->has('lat')) {
            return distance($request->lat, $request->long, $this->lat, $this->long);
        }

        return;
    }

    public function getRatingAttribute()
    {
        return (double) DB::table('destinasi_wisata_review_wisata')->selectRaw("AVG(tingkat_kepuasan) as rating")->first()->rating;
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
