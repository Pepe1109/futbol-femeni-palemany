<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{
    use HasFactory;

    // IMPORTANTE: Deben coincidir con la migración
    protected $fillable = ['local_id', 'visitant_id', 'data', 'resultat'];

    // Relación con el equipo Local
    public function local()
    {
        return $this->belongsTo(Equip::class, 'local_id');
    }

    // Relación con el equipo Visitante
    public function visitant()
    {
        return $this->belongsTo(Equip::class, 'visitant_id');
    }
    
    // Alias para compatibilidad si usas equipLocal en otros sitios
    public function equipLocal() { return $this->local(); }
    public function equipVisitant() { return $this->visitant(); }
}