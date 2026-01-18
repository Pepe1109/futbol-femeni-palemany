<?php

namespace App\Http\Controllers;

use App\Models\Partit;
use App\Models\Equip;
use Illuminate\Http\Request;

class PartitController extends Controller
{
    // Llistat de pròxims partits (o tots)
    public function index()
    {
        // Ordenamos por fecha (los más nuevos primero) y paginamos
        $partits = Partit::with(['local', 'visitant'])
                    ->orderBy('data', 'asc')
                    ->paginate(10);
                    
        return view('partits.index', compact('partits'));
    }

    // Llistat de partits ja jugats (HISTÒRIC)
    public function historic()
    {
        // Filtramos solo los que tienen resultado o fecha pasada
        $partits = Partit::with(['local', 'visitant'])
                    ->whereNotNull('resultat')
                    ->orWhere('data', '<', now())
                    ->orderBy('data', 'desc')
                    ->paginate(10);
                    
        return view('partits.index', compact('partits')); // Reutilizamos la vista index
    }

    public function create()
    {
        $equips = Equip::all();
        return view('partits.create', compact('equips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'local_id' => 'required|exists:equips,id',
            // Validamos que el visitante sea diferente al local
            'visitant_id' => 'required|exists:equips,id|different:local_id', 
            'data' => 'required|date',
            'resultat' => 'nullable|string|max:20', // Ej: "2-1"
        ]);

        Partit::create($validated);

        return redirect()->route('partits.index')->with('success', 'Partit programat correctament!');
    }

    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant'])->findOrFail($id);
        return view('partits.show', compact('partit'));
    }

    public function edit($id)
    {
        $partit = Partit::findOrFail($id);
        $equips = Equip::all();
        return view('partits.edit', compact('partit', 'equips'));
    }

    public function update(Request $request, $id)
    {
        $partit = Partit::findOrFail($id);

        $validated = $request->validate([
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'data' => 'required|date',
            'resultat' => 'nullable|string|max:20',
        ]);

        $partit->update($validated);

        // Si vienes de editar, te devolvemos a la lista
        return redirect()->route('partits.index')->with('success', 'Marcador/Dades actualitzades.');
    }

    public function destroy($id)
    {
        $partit = Partit::findOrFail($id);
        $partit->delete();
        return redirect()->route('partits.index')->with('success', 'Partit cancel·lat.');
    }
}