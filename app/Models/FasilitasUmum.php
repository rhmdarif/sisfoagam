<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    use HasFactory;
    protected $table = "fasilitas_umum";
    protected $fillable = ['nama_fasilitas_umum', 'slug_fasilitas_umum', 'lat', 'long', 'keterangan', 'thumbnail'];
    protected $appends = ['jarak'];

    public function getJarakAttribute()
    {
        $request = request();
        if($request->has('long') && $request->has('lat')) {
            return distance($request->lat, $request->long, $this->lat, $this->long);
        }

        return;
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoFasilitasUmum::class, "fasilitas_umum_id", "id");
    }
}
