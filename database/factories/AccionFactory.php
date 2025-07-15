<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Accion>
 */
class AccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->sentence(2),
            'descripcion' => $this->faker->paragraph(),
            'tipo' => $this->faker->randomElement(['compra', 'venta', 'transferencia']),
            'monto' => $this->faker->randomFloat(2, 10, 10000),
            'fecha' => $this->faker->date(),
        ];
    }
}
