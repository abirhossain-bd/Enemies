<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email','mdabirhossain.bd.info@gmail.com')->first();
        if (!$user) {
            User::create([
                'name' => "Developer",
                'email' => "mdabirhossain.bd.info@gmail.com",
                'password' => Hash::make('@abir1234@'),
            ]);
        }else{
            $user->update([
                'name' => "Developer",
                'email' => "mdabirhossain.bd.info@gmail.com",
                'password' => Hash::make('@abir1234@'),
            ]);

        }

    }
}
