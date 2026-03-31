<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->firstOrCreate(
            ['email' => 'admin@atlvs.local'],
            [
                'name' => 'Admin ATLVS',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
    }
}