<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::Create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("12345678"),
            "description" => "admin account",
            "role_id" => 1
        ]);

        User::Create([
            "name" => "admin2",
            "email" => "admin2@gmail.com",
            "password" => Hash::make("12345678"),
            "description" => "admin2 account",
            "role_id" => 1
        ]);

    }
}
