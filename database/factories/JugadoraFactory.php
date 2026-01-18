<?php

namespace Database\Factories;

use App\Models\Jugadora;
use App\Models\Equip;
use Illuminate\Database\Eloquent\Factories\Factory;

class JugadoraFactory extends Factory
{
    protected $model = Jugadora::class;

    public function definition()
    {
        $posicions = ['Portera','Defensa','Migcampista','Davantera'];

        return [
            'equip_id' => Equip::factory(),
            'nom' => $this->faker->firstName,
            'cognoms' => $this->faker->lastName,
            'data_naixement' => $this->faker->dateTimeBetween('-35 years', '-18 years')->format('Y-m-d'),
            'dorsal' => $this->faker->numberBetween(1, 99),
            'posicio' => $this->faker->randomElement($posicions),
            'foto' => null,
        ];
    }
}