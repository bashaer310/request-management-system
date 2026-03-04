<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');

        $users = [
            [
                'name' => 'Manager',
                'email' => 'manager@sahab.com',
                'role' => UserRole::MANAGER,
            ],
            [
                'name' => 'User One',
                'email' => 'user1@sahab.com',
                'role' => UserRole::USER,
            ],
            [
                'name' => 'User Two',
                'email' => 'user2@sahab.com',
                'role' => UserRole::USER,
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    ...$user,
                    'password' => $password,
                ]
            );
        }
    }
}
