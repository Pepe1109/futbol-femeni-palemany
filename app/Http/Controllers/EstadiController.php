<?php

namespace App\Http\Controllers;

use App\Models\Estadi;
use Illuminate\Http\Request;
use App\Http\Requests\EstadiRequest; // si crees FormRequest

class EstadiController extends Controller
{
    public function index()
    {
        $estadis = Estadi::orderBy('nom')->paginate(15);
        return view('estadis.index', compact('estadis'));
    }

    public function create()
    {
        return view('estadis.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|min:3',
            'ciutat' => 'required|min:2',
            'capacitat' => 'required|integer|min:0',
            'equip_principal' => 'nullable|min:3'
        ]);

        Estadi::create($data);

        return redirect()->route('estadis.index')->with('success', 'Estadi creat correctament.');
    }

    public function show(Estadi $estadi)
    {
        return view('estadis.show', compact('estadi'));
    }

    public function edit(Estadi $estadi)
    {
        return view('estadis.edit', compact('estadi'));
    }

    public function update(Request $request, Estadi $estadi)
    {
        $data = $request->validate([
            'nom' => 'required|min:3',
            'ciutat' => 'required|min:2',
            'capacitat' => 'required|integer|min:0',
            'equip_principal' => 'nullable|min:3'
        ]);

        $estadi->update($data);

        return redirect()->route('estadis.index')->with('success', 'Estadi actualitzat.');
    }

    public function destroy(Estadi $estadi)
    {
        $estadi->delete();
        return redirect()->route('estadis.index')->with('success', 'Estadi eliminat.');
    }
}
