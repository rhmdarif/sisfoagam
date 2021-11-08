<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'no_hp' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|same:confirm_password',
        ]);

        if($validator->fails()) {
            return response()->json(ApiResponse::Error(null, 200, $validator->errors()->first()));
        }

        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => "USER",
            'status' => 1
        ]);

        return response()->json(ApiResponse::Ok(null, 200, "Register berhasil"));
    }
}
