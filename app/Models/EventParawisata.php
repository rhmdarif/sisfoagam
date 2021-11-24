<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParawisata extends Model
{
    use HasFactory;
    protected $table = "event_parawisata";
    protected $fillable = ['jenis_event', 'start_at', 'end_at', 'keterangan', 'foto', 'slug_event_parawisata'];
}
