<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Jugadora;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class JugadoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $equips = Equip::all();

        foreach ($equips as $equip) {

            // generem entre 18 i 24 jugadores per equip
            $numJugadores = rand(18, 24);

            // dorsals única per equip
            $dorsals = range(1, 30);
            shuffle($dorsals);

            for ($i = 0; $i < $numJugadores; $i++) {
                Jugadora::create([
                    'nom'            => $faker->firstNameFemale(),
                    'cognoms'        => $faker->lastName(),
                    'data_naixement' => $faker->dateTimeBetween('-35 years', '-16 years')->format('Y-m-d'),
                    'dorsal'         => array_pop($dorsals),
                    'foto'           => 'https://randomuser.me/api/portraits/women/' . rand(1, 90) . '.jpg',
                    'equip_id'       => $equip->id,
                ]);
            }
        }
    }
}
