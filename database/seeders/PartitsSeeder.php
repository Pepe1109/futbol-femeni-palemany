<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use Carbon\Carbon;
use Faker\Factory as Faker;

class PartitsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $equips = Equip::all();
        $estadis = Estadi::all();

        $jornada = 1;

        // Generem calendaris anada + tornada
        foreach ($equips as $local) {
            foreach ($equips as $visitant) {
                if ($local->id === $visitant->id) continue;

                // Assignem un estadi aleatori
                $estadi = $estadis->random();

                // Assignem data aleatòria propera
                $data = Carbon::now()->addDays($faker->numberBetween(1, 60))->format('Y-m-d');

                Partit::create([
                    'local_id' => $local->id,
                    'visitant_id' => $visitant->id,
                    'estadi_id' => $estadi->id,
                    'data' => $data,
                    'jornada' => $jornada,
                    'resultat' => null,  // encara no hi ha resultat
                ]);

                $jornada++;
            }
        }

        // Afegim resultats aleatoris si la data ja ha passat
        foreach (Partit::all() as $partit) {
            if (Carbon::parse($partit->data)->isPast()) {
                $partit->update([
                    'resultat' => rand(0,5) . '-' . rand(0,5)
                ]);
            }
        }
    }
}
