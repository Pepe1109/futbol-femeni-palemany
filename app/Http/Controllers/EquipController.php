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
        $data = $request->validated();

        // guardem fitxer si hi ha escut
        if ($request->hasFile('escut')) {
            $data['escut'] = $request->file('escut')->store('escuts','public');
        }

        $this->service->store($data);

        return redirect()->route('equips.index')->with('success', 'Equip creat.');
    }

    public function edit($id)
    {
        $equip = $this->service->find($id);
        return view('equips.edit', compact('equip'));
    }

    public function update(UpdateEquipRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->hasFile('escut')) {
            $data['escut'] = $request->file('escut')->store('escuts','public');
        }
        $this->service->update($id, $data);
        return redirect()->route('equips.index')->with('success','Equip actualitzat.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('equips.index')->with('success','Equip eliminat.');
    }

    public function show($id)
    {
        $equip = Equip::findOrFail($id);

        return view('equips.show', compact('equip'));
    }

}
