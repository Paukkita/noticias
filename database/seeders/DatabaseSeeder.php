<?php

namespace Database\Seeders;

use App\Models\Genero;
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
        $this->call([
            UserSeeder::class
        ]);
        $generos = [
            ['genero' => 'Fotografía'],
            ['genero' => 'Pintura'],
            ['genero' => 'Escultura'],
            ['genero' => 'Diseño'],
            ['genero' => 'Arquitectura'],
        ];
        
        foreach ($generos as $genero) {
            Genero::create($genero);
        }
    }
}