<?php

namespace App\Services;

use App\Repositories\EloquentPartitRepository;

class PartitService
{
    protected $repository;

    public function __construct(EloquentPartitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function listAll()
    {
        return $this->repository->all(); // Devuelve colección de Eloquent
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function store(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
