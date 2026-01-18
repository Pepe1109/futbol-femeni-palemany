<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadi extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'capacitat'];

    // Relación: Un estadio tiene muchos equipos (o uno)
    public function equips()
    {
        return $this->hasMany(Equip::class);
    }
}