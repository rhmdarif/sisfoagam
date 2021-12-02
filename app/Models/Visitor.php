<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'periode',
        'total',
        'mobile',
        'tablet',
        'desktop',
        'chrome',
        'firefox',
        'opera',
        'safari',
        'ie',
        'edge',
        'in_app',
        'windows',
        'linux',
        'mac',
        'android',
    ];

    public function getPeriodeFormatAttribute()
    {
        return date("d M Y", strtotime($this->periode));
    }
}
