<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAkomodasi extends Model
{
    use HasFactory;

    protected $table = "kategori_akomodasi";
    protected $fillable = ['nama_kategori_akomodasi', 'icon_kategori_akomodasi', 'slug_kategori_akomodasi'];

    public $timestamps = false;

    public function akomodasi()
    {
        return $this->hasMany(Akomodasi::class, "id");
    }
}
