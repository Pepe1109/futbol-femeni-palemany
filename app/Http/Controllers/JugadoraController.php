<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugadora;
use App\Models\Equip;

class JugadoraController extends Controller
{
    public function index()
    {
        $jugadores = Jugadora::with('equip')->paginate(10);
        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equips = Equip::all();
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        return view('jugadores.create', compact('equips', 'posicions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognoms' => 'required|string|max:255', // AFEGIT
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string',
            'dorsal' => 'nullable|integer',
            'data_naixement' => 'nullable|date',
        ]);

        Jugadora::create($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora creada correctament.');
    }

    public function show($id)
    {
        $jugadora = Jugadora::with('equip')->findOrFail($id);
        return view('jugadores.show', compact('jugadora'));
    }

    public function edit($id)
    {
        $jugadora = Jugadora::findOrFail($id);
        $equips = Equip::all();
        $posicions = ['Portera', 'Defensa', 'Migcampista', 'Davantera'];
        
        return view('jugadores.edit', compact('jugadora', 'equips', 'posicions'));
    }

    public function update(Request $request, $id)
    {
        $jugadora = Jugadora::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'cognoms' => 'required|string|max:255', // AFEGIT
            'equip_id' => 'required|exists:equips,id',
            'posicio' => 'required|string',
            'dorsal' => 'nullable|integer',
            'data_naixement' => 'nullable|date',
        ]);

        $jugadora->update($validated);

        return redirect()->route('jugadores.index')->with('success', 'Jugadora actualitzada correctament.');
    }

    public function destroy($id)
    {
        $jugadora = Jugadora::findOrFail($id);
        $jugadora->delete();
        return redirect()->route('jugadores.index')->with('success', 'Jugadora eliminada correctament.');
    }
}