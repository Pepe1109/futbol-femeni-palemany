<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Jugadora;
use App\Models\Partit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. USUARIOS FIJOS (Para que puedas hacer login) ---
        
        // Admin
        User::firstOrCreate([
            'email' => 'admin@test.com'
        ], [
            'name' => 'Admin Boss',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Equipo para el Manager
        $valencia = Equip::firstOrCreate([
            'nom' => 'Valencia CF'
        ], [
            'ciutat' => 'Valencia',
            'titols' => 5
        ]);

        // Manager del Valencia
        User::firstOrCreate([
            'email' => 'manager@test.com'
        ], [
            'name' => 'Manager Valencia',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'team_id' => $valencia->id,
        ]);

        // Manager Espía
        User::firstOrCreate([
            'email' => 'espia@test.com'
        ], [
            'name' => 'Manager Espia',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        // --- 2. DATOS DE RELLENO (Factories) ---
        // Si fallan porque no tienes los factories bien definidos, comenta estas líneas.

        // Crear 5 Estadios
        $estadis = Estadi::factory(5)->create();

        // Crear 10 Equipos extra (asignándoles estadios aleatorios)
        $equips = Equip::factory(10)->recycle($estadis)->create();

        // Crear Jugadoras (5 por equipo aprox)
        Jugadora::factory(50)->recycle($equips)->create();

        // Crear Partidos
        Partit::factory(10)->recycle($equips)->create();
    }
}