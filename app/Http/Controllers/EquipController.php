<?php

namespace App\Http\Controllers;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Http\Request;

class EquipController extends Controller
{
    // Muestra la lista de equipos
    public function index()
    {
        // CAMBIO CLAVE: Usamos paginate(10) en vez de all()
        // También cargamos el 'estadi' para optimizar la consulta (Eager Loading)
        $equips = Equip::with('estadi')->paginate(10);
        
        return view('equips.index', compact('equips'));
    }

    // Muestra el formulario para crear un nuevo equipo
    public function create()
    {
        // Pasamos los estadios para el desplegable
        $estadis = Estadi::all();
        return view('equips.create', compact('estadis'));
    }

    // Guarda el nuevo equipo en la base de datos
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

    // Muestra los detalles de un equipo
    public function show($id)
    {
        $equip = Equip::with(['estadi', 'jugadores'])->findOrFail($id);
        return view('equips.show', compact('equip'));
    }

    // Muestra el formulario de edición
    public function edit($id)
    {
        $equip = Equip::findOrFail($id);
        
        // POLICY: Solo el Admin o el Manager pueden entrar aquí
        // (Esto ya lo protege el middleware, pero no está de más)
        
        $estadis = Estadi::all();
        return view('equips.edit', compact('equip', 'estadis'));
    }

    // Actualiza el equipo
    public function update(Request $request, $id)
    {
        $equip = Equip::findOrFail($id);

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