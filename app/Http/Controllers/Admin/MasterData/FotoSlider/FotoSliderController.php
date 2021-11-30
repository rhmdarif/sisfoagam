<?php

namespace App\Http\Controllers\Admin\MasterData\FotoSlider;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use DB;


class FotoSliderController extends Controller
{
    //
    public function index()
    {
        $data['slider'] = DB::table('sliders')->get();
        return view("admin.master_data.foto_slider.index", $data);
    }

    public function destroy($id)
    {
        DB::table('sliders')->where('id',$id)->delete();
       
        return redirect()
            ->route('admin.foto-slider.index');
    }

    public function edit($id)
    {
        
    }
}
