<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;

class EquipsSeeder extends Seeder
{
    public function run()
    {
        // seeds explícits
        Equip::create(['nom' => 'Barça Femení', 'ciutat' => 'Barcelona', 'lliga' => 'Lliga F']);
        Equip::create(['nom' => 'Atlètic de Madrid Femení', 'ciutat' => 'Madrid', 'lliga' => 'Lliga F']);
        Equip::create(['nom' => 'Real Madrid Femení', 'ciutat' => 'Madrid', 'lliga' => 'Lliga F']);

        // crear més equips amb factory si cal
        Equip::factory()->count(15)->create();
    }
}
