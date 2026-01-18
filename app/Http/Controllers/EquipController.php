<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;
// 1. IMPORTANTE: Necesitamos importar el Gate para llamar al "portero"
use Illuminate\Support\Facades\Gate;

class EquipController extends Controller
{
    // Muestra la lista de equipos
    public function index()
    {
        $equips = Equip::with('estadi')->paginate(10);
        return view('equips.index', compact('equips'));
    }

    // Muestra el formulario para crear un nuevo equipo
    public function create()
    {
        $estadis = Estadi::all();
        return view('equips.create', compact('estadis'));
    }

    // Guarda el nuevo equipo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ciutat' => 'required|string|max:255',
            'estadi_id' => 'nullable|exists:estadis,id',
            'titols' => 'integer|min:0',
        ]);

        Equip::create($validated);

        return redirect()->route('equips.index')->with('success', 'Equip creat correctament.');
    }

    // Muestra los detalles
    public function show($id)
    {
        $equip = Equip::with(['estadi', 'jugadores'])->findOrFail($id);
        return view('equips.show', compact('equip'));
    }

    // Muestra el formulario de edición
    public function edit($id)
    {
        $equip = Equip::findOrFail($id);
        
        // 2. SEGURIDAD: Aquí activamos la Policy
        // Si no eres Admin o el Manager de ESTE equipo, te echa fuera (403)
        Gate::authorize('update', $equip);
        
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }

    // Actualiza el equipo
    public function update(Request $request, $id)
    {
        $equip = Equip::findOrFail($id);

        // 3. SEGURIDAD: Aquí también, por si intentan enviar el formulario a la fuerza
        Gate::authorize('update', $equip);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'ciutat' => 'required|string|max:255',
            'estadi_id' => 'nullable|exists:estadis,id',
            'titols' => 'integer|min:0',
        ]);

        $equip->update($validated);

        return redirect()->route('equips.index')->with('success', 'Equip actualitzat correctament.');
    }

    // Elimina el equipo
    public function destroy($id)
    {
        $equip = Equip::findOrFail($id);
        $equip->delete();

        return redirect()->route('equips.index')->with('success', 'Equip eliminat correctament.');
    }
}