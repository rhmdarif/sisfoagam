<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = [
            [
                'name' => "Admin",
                'email' =>  "admin@mail.com",
                'no_hp' => "08123456789",
                'password' => Hash::make("admin123"),
                'role' => "ADMIN",
                'status' => 1,
            ],
            [
                'name' => "User",
                'email' =>  "user@mail.com",
                'no_hp' => "081234567890",
                'password' => Hash::make("user123"),
                'role' => "USER",
                'status' => 1,
            ]
        ];

        // foreach ($users as $value) {
        //     # code...
        // }
        DB::table('users')->insert($users);
    }
}
