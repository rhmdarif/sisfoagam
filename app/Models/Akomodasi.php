<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Akomodasi extends Model
{
    use HasFactory;

    protected $table = "akomodasi";

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
