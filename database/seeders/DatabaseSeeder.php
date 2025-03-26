<?php

namespace Database\Seeders;

use App\Models\Noticia;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create(); 
        Noticia::factory(10)->create();
        User::Create([
            'name' => 'Pau',
            'email' => 'pau@gmail.com',
            'password' => Hash::make('1234'),
            'is_admin' => true
        ]); 
    }
}