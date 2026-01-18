<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    // HE AÑADIDO 'ciutat' QUE TAMBIÉN TE IBA A DAR ERROR
    protected $fillable = ['nom', 'ciutat', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    // --- ESTA ES LA FUNCIÓN QUE FALTABA PARA VER LAS JUGADORAS ---
    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }
    // -------------------------------------------------------------

    public function manager()
    {
        return $this->hasOne(User::class, 'team_id');
    }
}