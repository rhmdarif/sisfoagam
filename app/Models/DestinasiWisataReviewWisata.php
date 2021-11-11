<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DestinasiWisataReviewWisata extends Model
{
    use HasFactory;
    protected $table = "destinasi_wisata_review_wisata";
    protected $fillable = ['destinasi_wisata_id', 'user_id', 'tingkat_kepuasan', 'komentar'];
}
