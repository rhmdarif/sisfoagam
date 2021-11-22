<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasAkomodasi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "fasilitas_akomodasi";
    protected $fillable = ['nama_fasilitas_akomodasi', 'icon_fasilitas_akomodasi'];
}
