<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoVideoAkomodasi extends Model
{
    use HasFactory;
    protected $table = "foto_video_akomodasi";

    public function akomodasi()
    {
        return $this->belongsTo(Akomodasi::class, "akomodasi_id", "id");
    }
}
