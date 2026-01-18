<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'estadi_id', 'titols', 'escut'];

    // Relación con Estadi
    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    // Relación con Jugadores
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    // --- LA MAGIA: CALCULAR LA FORMA (GGEDE) ---
    public function getFormaAttribute()
    {
        // 1. Buscamos los últimos 5 partidos donde este equipo haya jugado (Local o Visitante)
        // Y que ya tengan resultado puesto.
        $partits = Partit::where(function($q) {
                $q->where('local_id', $this->id)
                  ->orWhere('visitant_id', $this->id);
            })
            ->whereNotNull('resultat') // Solo partidos jugados
            ->orderBy('data', 'desc')  // Los más recientes primero
            ->take(5)                  // Solo los últimos 5
            ->get();

        $resultats = [];

        // 2. Analizamos cada partido
        foreach($partits as $partit) {
            // El resultado es tipo "2-1". Lo separamos.
            $gols = explode('-', $partit->resultat);
            
            // Si el formato no es correcto (ej: "Suspès"), saltamos
            if(count($gols) != 2) continue; 

            $local = (int)$gols[0];
            $visitant = (int)$gols[1];

            if ($partit->local_id == $this->id) {
                // Somos LOCALES
                if ($local > $visitant) $resultats[] = 'G'; // Guanyat
                elseif ($local < $visitant) $resultats[] = 'D'; // Derrota
                else $resultats[] = 'E'; // Empat
            } else {
                // Somos VISITANTES
                if ($visitant > $local) $resultats[] = 'G'; // Guanyat
                elseif ($visitant < $local) $resultats[] = 'D'; // Derrota
                else $resultats[] = 'E'; // Empat
            }
        }

        return $resultats; // Devuelve algo como ['G', 'E', 'D', 'G']
    }
}