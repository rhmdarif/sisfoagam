<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view("admin.auth.login");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nohp' => 'required|string|exists:users,no_hp',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $user = User::where('no_hp', $request->nohp)->first();
        if(!Hash::check($request->password, $user->password)) {
            return back()->with("error", "Password Salah");
        }

        Auth::login($user);

        return redirect()->route("admin.home");
    }
}
