<?php

namespace App\Repositories;

use App\Models\Estadi;

class EloquentEstadiRepository implements EstadiRepository
{
    protected $model;

    public function __construct(Estadi $estadi)
    {
        $this->model = $estadi;
    }

    public function all(array $columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $item = $this->model->findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id)
    {
        $item = $this->model->findOrFail($id);
        return $item->delete();
    }
}
