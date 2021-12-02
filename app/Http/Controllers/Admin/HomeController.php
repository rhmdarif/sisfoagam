<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        return view('admin.home');
    }

    public function chart()
    {
        $date = date("Y-m-d");
        $last_week = date("Y-m-d", strtotime('-7 days', strtotime($date)));
        $master_data = Visitor::select("mobile", "tablet", "desktop", "periode")->whereBetween("periode", [$last_week, $date])->get()->append(['periode_format']);

        $browser = [
            'chrome' => (int) Visitor::sum("chrome"),
            'firefox' => (int) Visitor::sum("firefox"),
            'opera' => (int) Visitor::sum("opera"),
            'safari' => (int) Visitor::sum("safari"),
            'ie' => (int) Visitor::sum("ie"),
            'edge' => (int) Visitor::sum("edge"),
            'in_app' => (int) Visitor::sum("in_app"),
        ];
        return ['line' => $master_data, 'pie' => $browser];
    }
}
