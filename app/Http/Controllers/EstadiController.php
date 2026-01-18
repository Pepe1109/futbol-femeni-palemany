<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use Illuminate\Http\Request;

class EstadiController extends Controller
{
    public function index()
    {
        // Paginamos de 10 en 10
        $estadis = Estadi::paginate(10);
        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:estadis',
            'ciutat' => 'required|string|max:255',
            'capacitat' => 'required|integer|min:100',
        ]);

        Estadi::create($validated);

        return redirect()->route('estadis.index')->with('success', 'Estadi inaugurat correctament!');
    }

    public function show($id)
    {
        // Cargamos los equipos que juegan aquí para mostrarlos en la ficha
        $estadi = Estadi::with('equips')->findOrFail($id);
        return view('estadis.show', compact('estadi'));
    }

    public function edit($id)
    {
        $estadi = Estadi::findOrFail($id);
        return view('estadis.edit', compact('estadi'));
    }

    public function update(Request $request, $id)
    {
        $estadi = Estadi::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:estadis,nom,' . $estadi->id,
            'ciutat' => 'required|string|max:255',
            'capacitat' => 'required|integer|min:100',
        ]);

        $estadi->update($validated);

        return redirect()->route('estadis.index')->with('success', 'Estadi reformat correctament.');
    }

    public function destroy($id)
    {
        $estadi = Estadi::findOrFail($id);
        
        // Opcional: Impedir borrar si hay equipos asignados
        if($estadi->equips()->count() > 0) {
            return back()->with('error', 'No pots enderrocar un estadi que té equips assignats!');
        }

        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi enderrocat.');
    }
}