<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@example.com')->first();

        if (!$admin) {
            User::create([
                'name' => 'Principal Admin',
                'email' => 'admin@santarosa.edu.ph',
                'password' => Hash::make('qwedcxzas'),
                'role' => 'Admin'
            ]);

            $this->command->info('Admin created successfully!');
        } else {
            $this->command->info('Admin already exists!');
        }

        
    }
}
