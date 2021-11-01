<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAkomodasi extends Model
{
    use HasFactory;

    protected $table = "kategori_akomodasi";

    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class, "id");
    }
}
