<?php

use Illuminate\Support\Facades\Storage;

if(!file_exists('storage_url')) {
    function storage_url($file_name)
    {
        $file_exists = Storage::disk('public')->exists($file_name);
        return ($file_exists)? url("storage/".$file_name) : '/img/noimages.png';
    }
}
