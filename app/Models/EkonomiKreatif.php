<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EkonomiKreatif extends Model
{
    use HasFactory;
    protected $table = "ekonomi_kreatif";

    public function kategori()
    {
        return $this->belongsTo(KategoriEkonomiKreatif::class, "kategori_ekonomi_kreatif_id");
    }

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoEkonomiKreatif::class, "ekonomi_kreatif_id", "id");
    }
}
