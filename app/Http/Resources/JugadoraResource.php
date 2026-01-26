<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JugadoraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom_complet' => $this->nom . ' ' . $this->cognoms, // Juntamos nombre y apellidos
            'posicio' => $this->posicio,
            'dorsal' => $this->dorsal,
            // Truco: Devolvemos el nombre del equipo y el ID, por si acaso
            'equip_id' => $this->equip_id,
            'equip_nom' => $this->equip ? $this->equip->nom : 'Sense equip',
        ];
    }
}