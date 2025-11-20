<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class EquipService
{
    protected $repo;

    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }

    public function listAll()
    {
        return $this->repo->all();
    }

    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function store(array $data)
    {
        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
