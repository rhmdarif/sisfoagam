<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapBoxController extends Controller
{
    //
    public function getLocation($location_1=array(), $location_2=array())
    {
        // return $location_1;
        $mapBox = Http::get("https://api.mapbox.com/directions/v5/mapbox/driving/".$location_1[0].",".$location_1[1].";".$location_2[0].",".$location_2[1]."?alternatives=false&continue_straight=false&geometries=geojson&overview=full&steps=false&access_token=pk.eyJ1IjoiZ2VtYWZhamFyMDk5IiwiYSI6ImNreDhnejludjM1NW4ydnEzbHBpcm1taGkifQ.7JBMmp6cwehXNhBx8lOL8w")->json();
        return $mapBox;
    }

    public static function takeLocation($location_1=array(), $location_2=array())
    {
        return (new self())->getLocation($location_1, $location_2);
    }

    public function fromController(Request $request)
    {
        return $this->getLocation([$request->lat_1, $request->long_1], [$request->lat_2, $request->long_2]);
    }
}
