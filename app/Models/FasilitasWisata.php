<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasWisata extends Model
{
    use HasFactory;
    protected $table = "fasilitas_wisata";
    protected $fillable = ['nama_fasilitas_wisata', 'icon_fasilitas_wisata'];
}
