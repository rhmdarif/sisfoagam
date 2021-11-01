<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
