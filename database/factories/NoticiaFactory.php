<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Noticia>
 */
class NoticiaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(),
            'fecha_publicacion' => $this->faker->date(),
            'descripcion' => $this->faker->paragraph(30),
            'imagen' => 'noticias/kiko.jpg',
            'genero' => $this->faker->randomElement(['Deportes', 'Política', 'Cultura', 'Tecnología'])
        ];
    }
}
