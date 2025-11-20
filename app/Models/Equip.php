<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'lliga', 'escut'];

    public function estadis() {
        // si voleu alta relació real useu relació específica; aquí per compatibilitat textual:
        return $this->hasMany(Estadi::class, 'equip_principal', 'nom');
    }

    public function jugadores()
    {
        return $this->hasMany(Jugadora::class);
    }

    public function partitsLocal()
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant()
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }
}
