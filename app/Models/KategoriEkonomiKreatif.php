<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriEkonomiKreatif extends Model
{
    use HasFactory;
    protected $table = "kategori_ekonomi_kreatif";
    protected $fillable = ['nama_kategori_kreatif', 'icon_kategori_kreatif', 'slug_kategori_kreatif'];
}
