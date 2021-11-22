<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaParawisata extends Model
{
    use HasFactory;
    protected $table = "berita_parawisata";
    protected $fillable = ['judul', 'narasi', 'foto', 'slug_berita_parawisata', 'posting_by'];
}
