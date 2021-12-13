<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BannerVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = $request->route()->getRouteName();
        $kategori = $request->route()->parameter('kategori');
        if(in_array($routeName, ['admin.master-data.banner.index','admin.master-data.banner.store'])) {
            if(!array($kategori, ['akomodasi'])) {
                return redirect()->back();
            } else {
                return $next($request);
            }
        } else {
            if(!array($kategori, ['akomodasi'])) {
                return response()->json(['status' => false, 'msg' => "kategori tidak tersedia"]);
            } else {
                return $next($request);
            }
        }
    }
}
