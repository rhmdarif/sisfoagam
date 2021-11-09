<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helper\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function show()
    {
        return response()->json(ApiResponse::Ok(collect(Auth::user())->except('token'), 200, "User ditemukan"));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'no_hp' => 'required|string'
        ]);

        if($validator->fails()) {
            return response()->json(ApiResponse::Error(null, 200, $validator->errors()->first()));
        }

        DB::table('users')->where('id', $user->id)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json(ApiResponse::Ok($request->only(["nama", 'email', 'no_hp']), 200, "Data berhasil diperbaharui"));
    }
}
