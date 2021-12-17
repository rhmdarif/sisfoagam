<?php

namespace App\Models;

use App\Http\Controllers\MapBoxController;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Akomodasi extends Model
{
    use HasFactory;

    protected $table = "akomodasi";
    protected $appends = ['jarak', 'rating'];

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

    public function getRatingAttribute()
    {
        return (double) DB::table('review_akomodasi')->selectRaw("AVG(tingkat_kepuasan) as rating")->first()->rating;
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriAkomodasi::class, "kategori_akomodasi_id");
    }

    public function fasilitas()
    {
        return $this->belongsToMany(FasilitasAkomodasi::class);
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoAkomodasi::class, "akomodasi_id", "id");
    }
}
