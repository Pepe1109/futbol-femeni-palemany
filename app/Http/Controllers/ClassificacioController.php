<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equip;
use App\Models\Partit;
use Illuminate\Http\Request;

class ClassificacioController extends Controller
{
    public function index()
    {
        // 1. Cargamos todos los equipos
        $equips = Equip::all();

        // 2. Cargamos todos los partidos jugados (con resultado)
        $partits = Partit::whereNotNull('resultat')->get();

        // 3. Inicializamos las estadísticas a 0 para cada equipo
        foreach ($equips as $equip) {
            $equip->pts = 0; // Puntos
            $equip->pj = 0;  // Partidos Jugados
            $equip->pg = 0;  // Partidos Ganados
            $equip->pe = 0;  // Partidos Empatados
            $equip->pp = 0;  // Partidos Perdidos
            $equip->gf = 0;  // Goles a Favor
            $equip->gc = 0;  // Goles en Contra
            $equip->dg = 0;  // Diferencia de Goles
        }

        // 4. Bucle mágico: Procesamos cada partido
        foreach ($partits as $partit) {
            $gols = explode('-', $partit->resultat);
            
            // Si el formato no es "X-Y", saltamos
            if (count($gols) != 2) continue;

            $golsLocal = (int)$gols[0];
            $golsVisitant = (int)$gols[1];

            // Buscamos los equipos en la colección (usamos 'find' dentro de la colección)
            $local = $equips->find($partit->local_id);
            $visitant = $equips->find($partit->visitant_id);

            if ($local && $visitant) {
                // Actualizamos partidos jugados y goles
                $local->pj++;
                $visitant->pj++;
                $local->gf += $golsLocal;
                $local->gc += $golsVisitant;
                $visitant->gf += $golsVisitant;
                $visitant->gc += $golsLocal;

                // Calculamos Puntos
                if ($golsLocal > $golsVisitant) {
                    // Gana Local
                    $local->pg++;
                    $local->pts += 3;
                    $visitant->pp++;
                } elseif ($golsLocal < $golsVisitant) {
                    // Gana Visitante
                    $visitant->pg++;
                    $visitant->pts += 3;
                    $local->pp++;
                } else {
                    // Empate
                    $local->pe++;
                    $local->pts += 1;
                    $visitant->pe++;
                    $visitant->pts += 1;
                }
            }
        }

        // 5. Calculamos la diferencia de goles final
        foreach ($equips as $equip) {
            $equip->dg = $equip->gf - $equip->gc;
        }

        // 6. ORDENAMOS LA TABLA (Puntos > Diferencia Goles > Goles a Favor)
        $classificacio = $equips->sortByDesc(function ($equip) {
            return [$equip->pts, $equip->dg, $equip->gf];
        });

        return view('classificacio.index', compact('classificacio'));
    }
}