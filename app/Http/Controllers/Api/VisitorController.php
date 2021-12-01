<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use hisorange\BrowserDetect\Parser;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Browser;


class VisitorController extends Controller
{
    //
    public function count(Request $request)
    {
        $userAgent = $request->ua ?? "";
        $browser = Browser::parse($userAgent);
        $periode = date("Y-m-d");

        $visitor = Visitor::where('periode', $periode)->first();

        if($browser->isMobile() || $browser->isTablet()
            || $browser->isChrome() || $browser->isFirefox() || $browser->isOpera() || $browser->isSafari() || $browser->isIE() || $browser->isEdge() || $browser->isInApp() || $browser->isInApp()
            || $browser->isWindows() || $browser->isLinux() || $browser->isMac() || $browser->isAndroid()) {
                if($visitor == null) {
                    Visitor::create([
                        'periode' => $periode,
                        'total' => 1,
                        'mobile' => ($browser->isMobile())? 1 : 0,
                        'tablet' => ($browser->isTablet())? 1 : 0,
                        'desktop' => ($browser->isDesktop())? 1 : 0,
                        'chrome' => ($browser->isChrome())? 1 : 0,
                        'firefox' => ($browser->isFirefox())? 1 : 0,
                        'opera' => ($browser->isOpera())? 1 : 0,
                        'safari' => ($browser->isSafari())? 1 : 0,
                        'ie' => ($browser->isIE())? 1 : 0,
                        'edge' => ($browser->isEdge())? 1 : 0,
                        'in_app' => ($browser->isInApp())? 1 : 0,
                        'windows' => ($browser->isWindows())? 1 : 0,
                        'linux' => ($browser->isLinux())? 1 : 0,
                        'mac' => ($browser->isMac())? 1 : 0,
                        'android' => ($browser->isAndroid())? 1 : 0,
                    ]);
                } else {
                    $visitor->update([
                        'total' => $visitor->total+1,
                        'mobile' => ($browser->isMobile())? $visitor->mobile+1 : $visitor->mobile,
                        'tablet' => ($browser->isTablet())? $visitor->tablet+1 : $visitor->tablet,
                        'desktop' => ($browser->isDesktop())? $visitor->desktop+1 : $visitor->desktop,
                        'chrome' => ($browser->isChrome())? $visitor->chrome+1 : $visitor->chrome,
                        'firefox' => ($browser->isFirefox())? $visitor->firefox+1 : $visitor->firefox,
                        'opera' => ($browser->isOpera())? $visitor->opera+1 : $visitor->opera,
                        'safari' => ($browser->isSafari())? $visitor->safari+1 : $visitor->safari,
                        'ie' => ($browser->isIE())? $visitor->ie+1 : $visitor->ie,
                        'edge' => ($browser->isEdge())? $visitor->edge+1 : $visitor->edge,
                        'in_app' => ($browser->isInApp())? $visitor->in_app+1 : $visitor->in_app,
                        'windows' => ($browser->isWindows())? $visitor->windows+1 : $visitor->windows,
                        'linux' => ($browser->isLinux())? $visitor->linux+1 : $visitor->linux,
                        'mac' => ($browser->isMac())? $visitor->mac+1 : $visitor->mac,
                        'android' => ($browser->isAndroid())? $visitor->android+1 : $visitor->android,
                    ]);
                }

                return ['pesan' => 'ok'];
            } else {
                return ['pesan' => 'bad'];
            }

    }
}
