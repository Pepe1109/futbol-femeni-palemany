<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Equip;
use App\Models\Estadi;
use App\Models\Jugadora;
use App\Models\Partit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "---- INICIANT LA CONFIGURACIÓ DE LA LLIGA F ----\n";

        // 1. USUARIOS (ACCESOS)
        User::create([
            'name' => 'Admin Pepe',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Marta Huerta (Àrbitra)',
            'email' => 'arbitre@test.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);

        // 2. DATOS COMPLETOS LIGA F (16 EQUIPOS)
        $datos = [
            [
                'equip' => 'FC Barcelona', 'ciutat' => 'Barcelona', 'estadi' => 'Estadi Johan Cruyff', 'cap' => 6000, 'titols' => 9, 
                'jugadores' => [['Aitana', 'Bonmatí', 'Mig', 14], ['Alexia', 'Putellas', 'Mig', 11], ['Salma', 'Paralluelo', 'Dav', 7], ['Cata', 'Coll', 'Por', 13], ['Mapi', 'León', 'Def', 4]]
            ],
            [
                'equip' => 'Real Madrid', 'ciutat' => 'Madrid', 'estadi' => 'Alfredo Di Stéfano', 'cap' => 6000, 'titols' => 0, 
                'jugadores' => [['Misa', 'Rodríguez', 'Por', 1], ['Olga', 'Carmona', 'Def', 7], ['Linda', 'Caicedo', 'Dav', 18], ['Teresa', 'Abelleira', 'Mig', 3], ['Caroline', 'Weir', 'Mig', 10]]
            ],
            [
                'equip' => 'Atlético de Madrid', 'ciutat' => 'Madrid', 'estadi' => 'C.D. Wanda Alcalá', 'cap' => 2700, 'titols' => 4, 
                'jugadores' => [['Lola', 'Gallardo', 'Por', 1], ['Ajibade', 'Rasheedat', 'Dav', 16], ['Carmen', 'Menayo', 'Def', 11], ['Gaby', 'García', 'Mig', 10]]
            ],
            [
                'equip' => 'Levante UD', 'ciutat' => 'València', 'estadi' => 'Ciutat de València', 'cap' => 26000, 'titols' => 0, 
                'jugadores' => [['María', 'Méndez', 'Def', 4], ['Alba', 'Redondo', 'Dav', 10], ['Andonova', 'Natasa', 'Mig', 8]]
            ],
            [
                'equip' => 'Madrid CFF', 'ciutat' => 'Fuenlabrada', 'estadi' => 'Fernando Torres', 'cap' => 6000, 'titols' => 0, 
                'jugadores' => [['Paola', 'Ulloa', 'Por', 1], ['Karen', 'Araya', 'Mig', 8], ['Monica', 'Hickmann', 'Def', 5]]
            ],
            [
                'equip' => 'Athletic Club', 'ciutat' => 'Bilbao', 'estadi' => 'Lezama', 'cap' => 3200, 'titols' => 5, 
                'jugadores' => [['Mariasun', 'Quiñones', 'Por', 1], ['Ane', 'Azkona', 'Dav', 10], ['Nerea', 'Nevado', 'Def', 3]]
            ],
            [
                'equip' => 'Real Sociedad', 'ciutat' => 'Donostia', 'estadi' => 'Zubieta', 'cap' => 2500, 'titols' => 1, 
                'jugadores' => [['Elene', 'Lete', 'Por', 1], ['Nerea', 'Eizagirre', 'Mig', 10], ['Sanni', 'Franssi', 'Dav', 9]]
            ],
            [
                'equip' => 'Sevilla FC', 'ciutat' => 'Sevilla', 'estadi' => 'Jesús Navas', 'cap' => 7500, 'titols' => 0, 
                'jugadores' => [['Esther', 'Sullastres', 'Por', 1], ['Amanda', 'Sampedro', 'Mig', 8], ['Inma', 'Gabarro', 'Dav', 10]]
            ],
            [
                'equip' => 'UDG Tenerife', 'ciutat' => 'Granadilla', 'estadi' => 'La Palmera', 'cap' => 2700, 'titols' => 0, 
                'jugadores' => [['María José', 'Pérez', 'Dav', 7], ['Pisco', 'Raquel', 'Def', 4], ['Aline', 'Reis', 'Por', 1]]
            ],
            [
                'equip' => 'SD Eibar', 'ciutat' => 'Eibar', 'estadi' => 'Ipurua', 'cap' => 8164, 'titols' => 0, 
                'jugadores' => [['Noelia', 'García', 'Por', 1], ['Elba', 'Vergés', 'Def', 5], ['Andrea', 'Álvarez', 'Dav', 9]]
            ],
            [
                'equip' => 'Valencia CF', 'ciutat' => 'València', 'estadi' => 'Puchades', 'cap' => 2250, 'titols' => 0, 
                'jugadores' => [['Enith', 'Salón', 'Por', 1], ['Marta', 'Carro', 'Def', 5], ['Fiamma', 'Benítez', 'Mig', 10]]
            ],
            [
                'equip' => 'Real Betis', 'ciutat' => 'Sevilla', 'estadi' => 'Luis del Sol', 'cap' => 1300, 'titols' => 0, 
                'jugadores' => [['Paula', 'Vizoso', 'Por', 1], ['Nuria', 'Ligero', 'Def', 5], ['Rosa', 'Márquez', 'Mig', 7]]
            ],
            [
                'equip' => 'Granada CF', 'ciutat' => 'Granada', 'estadi' => 'Nuevo Los Cármenes', 'cap' => 19000, 'titols' => 0, 
                'jugadores' => [['Sandra', 'Estévez', 'Por', 13], ['Lauri', 'Requena', 'Dav', 7], ['Alicia', 'Redondo', 'Mig', 6]]
            ],
            [
                'equip' => 'Levante Badalona', 'ciutat' => 'Badalona', 'estadi' => 'Municipal Badalona', 'cap' => 4170, 'titols' => 0, 
                'jugadores' => [['Maria', 'Valenzuela', 'Por', 1], ['Estefanía', 'Banini', 'Mig', 22], ['Macarena', 'Portales', 'Dav', 11]]
            ],
            [
                'equip' => 'RCD Espanyol', 'ciutat' => 'Barcelona', 'estadi' => 'Dani Jarque', 'cap' => 1500, 'titols' => 1, 
                'jugadores' => [['Romane', 'Salvador', 'Por', 1], ['Daniela', 'Caracas', 'Def', 2], ['Lice', 'Chamorro', 'Dav', 9]]
            ],
            [
                'equip' => 'Deportivo Abanca', 'ciutat' => 'A Coruña', 'estadi' => 'Abegondo', 'cap' => 1000, 'titols' => 0, 
                'jugadores' => [['Yohana', 'Gómez', 'Por', 1], ['Henar', 'Muiña', 'Mig', 10], ['Millene', 'Cabral', 'Dav', 19]]
            ]
        ];

        $equiposInstances = [];

        foreach ($datos as $index => $dato) {
            // Estadi
            $estadi = Estadi::create([
                'nom' => $dato['estadi'],
                'ciutat' => $dato['ciutat'],
                'capacitat' => $dato['cap']
            ]);

            // Equip
            $equip = Equip::create([
                'nom' => $dato['equip'],
                'ciutat' => $dato['ciutat'],
                'estadi_id' => $estadi->id,
                'titols' => $dato['titols']
            ]);
            $equiposInstances[] = $equip;

            // Jugadores
            foreach ($dato['jugadores'] as $jug) {
                // Mapeo rápido de posiciones
                $posCompleta = match($jug[2]) {
                    'Por' => 'Portera',
                    'Def' => 'Defensa',
                    'Mig' => 'Migcampista',
                    'Dav' => 'Davantera',
                    default => 'Jugadora'
                };

                Jugadora::create([
                    'nom' => $jug[0],
                    'cognoms' => $jug[1],
                    'posicio' => $posCompleta,
                    'dorsal' => $jug[3],
                    'equip_id' => $equip->id,
                    'data_naixement' => now()->subYears(rand(17, 34))->subDays(rand(0, 365))
                ]);
            }

            // MANAGER PARA EL BARÇA (Index 0)
            if ($index === 0) {
                User::create([
                    'name' => 'Manager Culé',
                    'email' => 'manager@test.com',
                    'password' => Hash::make('password'),
                    'role' => 'manager',
                    'team_id' => $equip->id,
                ]);
            }
        }

        // 3. SIMULACIÓN MASIVA DE PARTIDOS (Para llenar la tabla)
        // 16 equipos = 240 partidos en total (ida y vuelta)
        echo "Simulant una temporada completa...\n";

        foreach ($equiposInstances as $local) {
            foreach ($equiposInstances as $visitant) {
                if ($local->id !== $visitant->id) {
                    
                    // Probabilidad alta de que el partido ya se haya jugado (para tener tabla llena)
                    $jugado = rand(0, 100) < 65; 

                    if ($jugado) {
                        // Lógica para que Barça y Madrid ganen más (realismo)
                        $powerLocal = ($local->nom === 'FC Barcelona' || $local->nom === 'Real Madrid') ? 2 : 0;
                        $powerVisitant = ($visitant->nom === 'FC Barcelona' || $visitant->nom === 'Real Madrid') ? 2 : 0;

                        $golesL = max(0, rand(0, 3) + $powerLocal + rand(-1, 1)); // Aleatoriedad controlada
                        $golesV = max(0, rand(0, 3) + $powerVisitant + rand(-1, 1));

                        Partit::create([
                            'local_id' => $local->id,
                            'visitant_id' => $visitant->id,
                            'data' => Carbon::now()->subDays(rand(1, 150))->setTime(rand(11, 21), 0),
                            'resultat' => "$golesL-$golesV"
                        ]);
                    } else {
                        // Partido futuro
                        Partit::create([
                            'local_id' => $local->id,
                            'visitant_id' => $visitant->id,
                            'data' => Carbon::now()->addDays(rand(1, 60))->setTime(rand(11, 21), 0),
                            'resultat' => null
                        ]);
                    }
                }
            }
        }
        
        echo "---- BD CONFIGURADA CORRECTAMENT ----\n";
    }
}