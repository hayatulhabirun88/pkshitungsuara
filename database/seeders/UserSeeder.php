<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin#123'),
            'level' => 'admin',
        ];
        \App\Models\User::create($data);
    }
}
