<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partit;
use App\Models\Equip;

class PartitController extends Controller
{
    // Mostrar todos los partidos
    public function index()
    {
        $partits = Partit::with(['local', 'visitant'])->get();
        return view('partits.index', compact('partits'));
    }

    // Mostrar un partido
    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant'])->find($id);

        if (!$partit) {
            return redirect()->route('partits.index')->with('error', 'Partit no trobat.');
        }

        return view('partits.show', compact('partit'));
    }

    // Formulario para editar
    public function edit($id)
    {
        $partit = Partit::find($id);

        if (!$partit) {
            return redirect()->route('partits.index')->with('error', 'Partit no trobat.');
        }

        $equips = Equip::all();

        return view('partits.edit', compact('partit', 'equips'));
    }

    // Guardar cambios
    public function update(Request $request, $id)
    {
        $partit = Partit::find($id);

        if (!$partit) {
            return redirect()->route('partits.index')->with('error', 'Partit no trobat.');
        }

        $request->validate([
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'data' => 'required|date',
            'resultat' => 'nullable|string|max:20',
        ]);

        $partit->update($request->all());

        return redirect()->route('partits.show', $partit->id)
                         ->with('success', 'Partit actualitzat correctament.');
    }
}
