<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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
        // Si hi ha un fitxer 'escut', el guardem al disc públic
        if (isset($data['escut']) && $data['escut'] instanceof UploadedFile) {
            $data['escut'] = $data['escut']->store('escuts', 'public');
        }

        return $this->repo->create($data);
    }

    public function update($id, array $data)
    {
        $equip = $this->repo->find($id);

        if (isset($data['escut']) && $data['escut'] instanceof UploadedFile) {
            // Esborrem l'escut antic si existeix per no acumular brossa
            if ($equip->escut) {
                Storage::disk('public')->delete($equip->escut);
            }
            // Guardem el nou
            $data['escut'] = $data['escut']->store('escuts', 'public');
        }
        
        return $this->repo->update($id, $data);
    }

    public function delete($id)
    {
        $equip = $this->repo->find($id);
        
        // Opcional: Esborrar l'imatge quan s'esborra l'equip
        if ($equip->escut) {
            Storage::disk('public')->delete($equip->escut);
        }

        return $this->repo->delete($id);
    }
}