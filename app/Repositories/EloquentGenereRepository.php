<?php

namespace App\Repositories;

use App\Models\Genere;

class EloquentGenereRepository implements GenereRepository
{
    public function all()
    {
        return Genere::all();
    }

    public function find($id)
    {
        return Genere::find($id);
    }
}
