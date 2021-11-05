<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkonomiKreatif extends Model
{
    use HasFactory;
    protected $table = "ekonomi_kreatif";
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
        return $this->belongsTo(KategoriEkonomiKreatif::class, "kategori_ekonomi_kreatif_id");
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoEkonomiKreatif::class, "ekonomi_kreatif_id", "id");
    }
}
