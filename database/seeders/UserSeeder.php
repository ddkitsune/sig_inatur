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
        \App\Models\User::create([
            'name' => 'Deivy (Administrador)',
            'email' => 'admin@inatur.gob.ve',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        \App\Models\User::create([
            'name' => 'Analista Sigma',
            'email' => 'analista@inatur.gob.ve',
            'password' => bcrypt('analista123'),
            'role' => 'analista',
        ]);
    }
}
