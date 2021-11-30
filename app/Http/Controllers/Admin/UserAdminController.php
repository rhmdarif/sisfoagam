<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = User::where("role", "ADMIN")->get();
        return view("admin.user_admin.index", compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string|digits_between:10,13|unique:users,no_hp',
            'password' => 'required|string',
            'level' => 'required|string',
            'status' => 'required|in:1,0',
        ]);

        if($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'status' => $request->status,
            'role' => "ADMIN",
        ]);

        return back()->with("success", "Admin ".$request->name." telah ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        if($admin->role != "ADMIN") {
            return back();
        }

        return view("admin.user_admin.detail", ['user' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        //
        if($admin->role != "ADMIN") {
            return back()->with("error", "User tidak dapat diedit");
        }

        return view("admin.user_admin.edit", ['user' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'no_hp' => 'required|string|digits_between:10,13|unique:users,no_hp,'.$admin->id,
            'password' => 'nullable|string',
            'level' => 'required|string',
            'status' => 'required|in:1,0',
        ]);

        if($validator->fails()) {
            return back()->with('error', $validator->errors()->first());
        }

        $update = [
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'level' => $request->level,
            'status' => $request->status,
        ];

        if($request->filled('password')) {
            $update['password'] = Hash::make($request->password);
        }

        $admin->update($update);

        return back()->with("success", "Admin ".$request->name." telah diperbaharui");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        //
        $admin->delete();
        return ['pesan' => "berhasil"];
    }
}
