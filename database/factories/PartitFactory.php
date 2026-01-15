<?php

namespace Database\Factories;

use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartitFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Usamos los mismos nombres: local_id y visitant_id
            'local_id' => Equip::factory(),
            'visitant_id' => Equip::factory(),
            'data' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'resultat' => $this->faker->optional()->randomElement(['1-0', '2-2', '0-3', '1-1']),
        ];
    }
}