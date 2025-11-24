<?php

namespace App\Repositories;

interface GenereRepository
{
    public function all();
    public function find($id);
}
