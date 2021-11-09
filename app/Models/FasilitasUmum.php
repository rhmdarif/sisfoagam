<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasUmum extends Model
{
    use HasFactory;
    protected $table = "fasilitas_umum";

    public function fotovideo()
    {
        return $this->hasMany(FotoVideoFasilitasUmum::class, "fasilitas_umum_id", "id");
    }
}
