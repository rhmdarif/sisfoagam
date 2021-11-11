<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewEkonomiKreatif extends Model
{
    use HasFactory;
    protected $table = "review_ekonomi_kreatif";
    protected $fillable = ['ekonomi_kreatif_id', 'user_id', 'tingkat_kepuasan', 'komentar'];
}
