<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'login' => 'admin',
        ], [
            'name' => 'Админ',
            'role' => User::ROLE_ADMIN,
            'password' => app('hash')->make('1234567'),
        ]);
    }
}
