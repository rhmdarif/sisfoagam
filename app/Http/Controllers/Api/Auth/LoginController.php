<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json(ApiResponse::Error(null, 200, $validator->errors()->first()));
        }

        $user = DB::table('users')->where('email', $request->email)->first();

        if(!Hash::check($request->password, $user->password)) {
            return response()->json(ApiResponse::Error(null, 200, "Password tidak valid."));
        }
        $userAgent = $request->header("User-Agent") ?? "";
        $token = DB::table('user_tokens')->select("user_id", "user_agent", "token")->where('user_id', $user->id)->where('user_agent', $userAgent)->first();

        if($token == null) {
            $add_token = [
                'user_id' => $user->id,
                'user_agent' => $userAgent,
                'token' => Hash::make($user->id."-".$userAgent)
            ];
            $token_id = DB::table('user_tokens')->insertGetId($add_token);

            $token = collect($add_token);
        }

        return response()->json(ApiResponse::Ok($token, 200, "Login berhasil"));
    }
}
