<?php

namespace App\Services;

use App\Repositories\GenereRepository;

class GenereService
{
    protected $genereRepo;

    public function __construct(GenereRepository $genereRepo)
    {
        $this->genereRepo = $genereRepo;
    }

    public function getAll()
    {
        return $this->genereRepo->all();
    }

    public function find($id)
    {
        return $this->genereRepo->find($id);
    }
}
