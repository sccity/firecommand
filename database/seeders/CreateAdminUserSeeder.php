<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@santaclarautah.gov'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
                'department' => 'IT'
            ]
        );

        $user->assignRole('super_admin');
    }
}
