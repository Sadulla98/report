<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Manager',
            'role_id' => 1,
            'email' => 'test@mail.ru',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Client',
            'role_id' => 2,
            'email' => 'test2@mail.ru',
            'password' => Hash::make('12345678'),
        ]);
    }
}
