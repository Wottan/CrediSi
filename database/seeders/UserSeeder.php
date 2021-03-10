<?php

namespace Database\Seeders; 

use Illuminate\Database\Seeder;
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
        \App\Models\User::factory(1)->create([
            "name" => "Admin",
            "email" => "admin@admin.com",
            "password" => Hash::make("password"),
            "email_verified_at" => now()
        ]);
    }
}
