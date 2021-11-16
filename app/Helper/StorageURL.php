<?php

use Illuminate\Support\Facades\Storage;

if(!file_exists('storage_url')) {
    function storage_url($tb_name, $file_name)
    {
        $file_exists = Storage::disk('public')->exists($tb_name."/".$file_name);
        return ($file_exists)? url("storage/".$tb_name."/".$file_name) : '/img/noimages.png';
    }
}
