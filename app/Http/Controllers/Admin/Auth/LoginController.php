<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;

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

    public function daftar()
    {
        return view("admin.auth.register");
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'nohp' => 'required|string',
            'email' => 'required',
            'password' => 'required|string'
        ]);

        if($validator->fails()) {
            return back()->with("error", $validator->errors()->first());
        }

        $register = new User();
        $register->name = $request->name;
        $register->no_hp = $request->nohp;
        $register->email = $request->email;
        $register->password = Hash::make($request->password);
        $register->save();

        return redirect()->route("admin.login");
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/dashboard');
    }
}
