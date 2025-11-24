<?php

namespace App\Http\Controllers;

use App\Services\EstadiService;
use App\Http\Requests\StoreEstadiRequest;
use App\Http\Requests\UpdateEstadiRequest;
use App\Models\Equip;

class EstadiController extends Controller
{
    protected $service;

    public function __construct(EstadiService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $estadis = $this->service->listAll();
        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(StoreEstadiRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('estadis.index')->with('success', 'Estadi creat.');
    }

    public function edit($id)
    {
        $estadi = $this->service->find($id);
        return view('estadis.edit', compact('estadi'));
    }

    public function update(UpdateEstadiRequest $request, $id)
    {
        $data = $request->validated();
        $this->service->update($id, $data);
        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat.');
    }

    public function show($id)
    {
        $estadi = $this->service->find($id);
        return view('estadis.show', compact('estadi'));
    }
}
