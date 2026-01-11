<?php

namespace App\Http\Controllers;

use App\Services\EquipService;
use App\Http\Requests\StoreEquipRequest;
use App\Http\Requests\UpdateEquipRequest;
use App\Models\Equip;

class EquipController extends Controller
{
    protected $service;

    public function __construct(EquipService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $equips = $this->service->listAll();
        return view('equips.index', compact('equips'));
    }

    public function create()
    {
        return view('equips.create');
    }

    public function store(StoreEquipRequest $request)
    {
        // Passem totes les dades validades (inclòs el fitxer d'imatge si n'hi ha) al servei
        $this->service->store($request->validated());

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }

    public function edit($id)
    {
        $equip = $this->service->find($id);
        return view('equips.edit', compact('equip'));
    }

    public function update(UpdateEquipRequest $request, $id)
    {
        // El servei s'encarrega de gestionar la pujada i substitució de la imatge
        $this->service->update($id, $request->validated());
        
        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('equips.index')->with('success', 'Equip eliminat.');
    }

    public function show($id)
    {
        $equip = Equip::findOrFail($id);
        return view('equips.show', compact('equip'));
    }
}