<?php

namespace App\Http\Controllers\Admin\MasterData\FotoSlider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class FotoSliderController extends Controller
{
    //
    public function index()
    {
        $slider = Slider::all();
        return view("admin.master_data.foto_slider.index", compact("slider"));
    }
}
