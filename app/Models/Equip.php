<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equip extends Model
{
    /** @use HasFactory<\Database\Factories\EquipFactory> */
    use HasFactory;

    // Afegim 'escut' a la llista de camps permesos
    protected $fillable = ['nom', 'estadi_id', 'titols', 'escut'];

    public function estadi()
    {
        return $this->belongsTo(Estadi::class);
    }

    // Nova relació: Un equip té un manager
    public function manager()
    {
        return $this->hasOne(User::class, 'team_id');
    }
}