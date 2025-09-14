<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registrar = User::where('email', 'admin@santarosa.edu.ph')->first();

        if (!$registrar) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@santarosa.edu.ph',
                'password' => Hash::make('Daniel Admin'),
                'role' => 'Admin'
            ]);

            $this->command->info('Admin created successfully!');
        } else {
            $this->command->info('Admin already exists!');
        }
    }
}
