<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewAkomodasi extends Model
{
    use HasFactory;
    protected $table = "review_akomodasi";
    protected $fillable = ['akomodasi_id', 'user_id', 'tingkat_kepuasan', 'komentar'];
}
