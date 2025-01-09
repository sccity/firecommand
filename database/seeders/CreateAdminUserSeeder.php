<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@santaclarautah.gov',
            'password' => Hash::make('Admin123!'),
            'department' => 'IT',
        ]);

        $admin->assignRole('super_admin');
    }
}
