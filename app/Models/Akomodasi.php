<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Akomodasi extends Model
{
    use HasFactory;

    protected $table = "akomodasi";
    // protected $appends = ['jarak'];

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
