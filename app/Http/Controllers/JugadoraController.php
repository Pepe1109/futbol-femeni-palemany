<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JugadoraService;
use App\Services\EquipService;
use App\Services\GenereService;

class JugadoraController extends Controller
{
    protected $jugadoraService;
    protected $equipService;
    protected $genereService;

    public function __construct(
        JugadoraService $jugadoraService,
        EquipService $equipService,
        GenereService $genereService
    ) {
        $this->jugadoraService = $jugadoraService;
        $this->equipService = $equipService;
        $this->genereService = $genereService;
    }

    // Listar todas las jugadoras
    public function index()
    {
        $jugadoras = $this->jugadoraService->getAll();
        return view('jugadoras.index', compact('jugadoras'));
    }

    // Ver una jugadora
    public function show($id)
    {
        $jugadora = $this->jugadoraService->find($id);

        if (!$jugadora) {
            return redirect()->route('jugadoras.index')->with('error', 'Jugadora no encontrada');
        }

        return view('jugadoras.show', compact('jugadora'));
    }

    // Mostrar formulario para editar
    public function edit($id)
    {
        $jugadora = $this->jugadoraService->find($id);
        if (!$jugadora) {
            return redirect()->route('jugadoras.index')->with('error', 'Jugadora no encontrada');
        }

        $equips = $this->equipService->getAll();
        $generes = $this->genereService->getAll();

        return view('jugadoras.edit', compact('jugadora', 'equips', 'generes'));
    }

    // Actualizar jugadora
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'edat' => 'required|integer|min:1',
            'equip_id' => 'required|exists:equips,id',
            'genere_id' => 'required|exists:generes,id',
        ]);

        $jugadora = $this->jugadoraService->update($id, $validated);

        return redirect()->route('jugadoras.show', $jugadora->id)
            ->with('success', 'Jugadora actualizada correctamente');
    }
}
