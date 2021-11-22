<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EkonomiKreatif extends Model
{
    use HasFactory;
    protected $table = "ekonomi_kreatif";
    protected $fillable = ['kategori_ekonomi_kreatif_id', 'nama_ekonomi_kreatif', 'slug_ekonomi_kreatif', 'harga', 'lat', 'long', 'thumbnail_ekonomi_kreatif', 'keterangan'];
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
        return (double) DB::table('review_ekonomi_kreatif')->selectRaw("AVG(tingkat_kepuasan) as rating")->first()->rating;
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriEkonomiKreatif::class, "kategori_ekonomi_kreatif_id");
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoEkonomiKreatif::class, "ekonomi_kreatif_id", "id");
    }
}
