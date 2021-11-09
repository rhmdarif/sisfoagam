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
            $user_token = DB::table('user_tokens')->where("token", $token)->first();
            // $user = DB::table('user_tokens')
            //             ->select('users.id')
            //             ->join("users", "users.id", "=", "user_tokens.user_id")
            //             ->where("user_tokens.token", $token)
            //             ->first();
                // return response()->json(ApiResponse::Error(null, 200, $user));
            if($user_token == null) {
                return response()->json(ApiResponse::Error(null, 200, "Token tidak valid"));
            } else {
                $user = User::find($user_token->user_id);

                Auth::login($user);
                return $next($request);
            }
        } else {
            return response()->json(ApiResponse::Error(null, 200, "Token diperlukan"));
        }
    }
}
