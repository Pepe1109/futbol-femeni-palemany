<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            EquipsSeeder::class,
            EstadisSeeder::class,
            JugadoresSeeder::class,
            PartitsSeeder::class,
        ]);
    }
}
