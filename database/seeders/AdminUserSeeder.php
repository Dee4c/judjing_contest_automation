<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin user already exists
        $adminUser = User::where('username', 'admin')->first();
        if (!$adminUser) {
            // Create the admin user
            User::create([
                'username' => 'admin',
                'password' => Hash::make('admin1'), // Change this to a secure password
            ]);
        }
    }
}
