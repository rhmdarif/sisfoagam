<?php

namespace App\Http\Middleware;

use Closure;
use App\Helper\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerifyApi
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
        $token = $request->bearerToken();
        if(isset($token)) {
            // return response()->json(ApiResponse::Error(null, 200, $token));
            $user = User::join("user_tokens", "user_tokens.user_id", "=", "users.id")
                        ->where("user_tokens.token", $token)
                        ->first();
            // $user = DB::table('user_tokens')
            //             ->select('users.id')
            //             ->join("users", "users.id", "=", "user_tokens.user_id")
            //             ->where("user_tokens.token", $token)
            //             ->first();
                // return response()->json(ApiResponse::Error(null, 200, $user));
            if($user == null) {
                return response()->json(ApiResponse::Error(null, 200, "Token tidak valid"));
            } else {
                Auth::login($user);
                return $next($request);
            }
        } else {
            return response()->json(ApiResponse::Error(null, 200, "Token diperlukan"));
        }
    }
}
