<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define your primary administrator details
        $adminEmail = 'admin@cvsu.com.ph';

        // Optional safety step: Ensure we don't duplicate the user if run multiple times
        if (!User::where('email', $adminEmail)->exists()) {
            
            $adminData = [
                'user_type' => 'Root',
                'name' => 'Administrator',
                'email' => $adminEmail,
                'password' => Hash::make('12345678'), // Change this to a secure password
                'email_verified_at' => now(),
            ];

            // If you have added an 'is_admin' boolean column to your users table migration, 
            // we dynamically include it here so the system doesn't throw a column-not-found error.
            if (Schema::hasColumn('users', 'is_admin')) {
                $adminData['is_admin'] = true;
            }

            User::create($adminData);

            $this->command->info('Admin account successfully created!');
            $this->command->info('Email: ' . $adminEmail);
            $this->command->info('Password: 12345678');
        } else {
            $this->command->warn('Admin account with email ' . $adminEmail . ' already exists.');
        }
    }
}