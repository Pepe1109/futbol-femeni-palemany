<?php

namespace Database\Factories;

use App\Models\Estadi;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadiFactory extends Factory
{
    protected $model = Estadi::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->company . ' Stadium',
            'ciutat' => $this->faker->city,
            'capacitat' => $this->faker->numberBetween(1000, 40000),
            'equip_principal' => null,
        ];
    }
}
