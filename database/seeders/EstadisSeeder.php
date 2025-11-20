<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estadi;

class EstadisSeeder extends Seeder
{
    public function run()
    {
        Estadi::create([
            'nom' => 'Estadi Johan Cruyff',
            'ciutat' => 'Sant Joan Despí',
            'capacitat' => 6000,
            'equip_principal' => 'Barça Femení'
        ]);

        Estadi::create([
            'nom' => 'Centro Deportivo Wanda Alcalá de Henares',
            'ciutat' => 'Alcalá de Henares',
            'capacitat' => 2800,
            'equip_principal' => 'Atlètic de Madrid Femení'
        ]);

        Estadi::create([
            'nom' => 'Estadio Alfredo Di Stéfano',
            'ciutat' => 'Madrid',
            'capacitat' => 6000,
            'equip_principal' => 'Real Madrid Femení'
        ]);

        Estadi::factory()->count(5)->create();
    }
}
