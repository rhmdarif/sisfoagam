<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MapBoxController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FasilitasUmum extends Model
{
    use HasFactory;
    protected $table = "fasilitas_umum";
    protected $fillable = ['nama_fasilitas_umum', 'slug_fasilitas_umum', 'lat', 'long', 'keterangan', 'thumbnail'];
    protected $appends = ['jarak', 'jarak_aktual'];

    public function getJarakAttribute()
    {
        $request = request();
        if($request->has('long') && $request->has('lat')) {
            return distance($request->lat, $request->long, $this->lat, $this->long);
        }

        return;
    }

    public function getJarakAktualAttribute()
    {
        $request = request();
        if($request->has('long') && $request->has('lat')) {
            $mapbox = MapBoxController::takeLocation([$request->long, $request->lat], [$this->long, $this->lat]);
            if(isset($mapbox['routes'])) {
                return $mapbox['routes'][0]['distance'];
            } else {
                return $mapbox;
            }
        }

        return;
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoFasilitasUmum::class, "fasilitas_umum_id", "id");
    }
}
