<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkomodasiVisitor extends Model
{
    use HasFactory;
    protected $fillable = ['periode', 'visitor', 'akomodasi_id'];
}
