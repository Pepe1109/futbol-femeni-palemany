<?php

namespace App\Http\Controllers\Api;

use App\Models\Jugadora;
use Illuminate\Http\Request;
use App\Http\Resources\JugadoraResource; // Asegúrate de haber creado este Resource
use Illuminate\Support\Facades\Validator;

class JugadoraController extends BaseController
{
    // GET /api/jugadores
    public function index()
    {
        $jugadores = Jugadora::paginate(10);
        return $this->sendResponse(JugadoraResource::collection($jugadores), 'Llistat de jugadores recuperat.');
    }

    // POST /api/jugadores (Admin o Manager de SU equipo)
    public function store(Request $request)
    {
        $user = $request->user();

        // Validación base
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'cognoms' => 'required|string',
            'posicio' => 'required|string',
            'dorsal' => 'required|integer',
            'equip_id' => 'required|exists:equips,id',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // SEGURIDAD MANAGER: Si intenta crear una jugadora para OTRO equipo -> Error
        if ($user->role === 'manager' && $user->team_id != $request->equip_id) {
             return $this->sendError('Unauthorized. Només pots fitxar pel teu equip.', [], 403);
        }
        
        // Si no es Admin ni Manager -> Error
        if ($user->role !== 'admin' && $user->role !== 'manager') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $jugadora = Jugadora::create($request->all());
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora fitxada correctament.');
    }

    // GET /api/jugadores/{id}
    public function show($id)
    {
        $jugadora = Jugadora::find($id);
        if (is_null($jugadora)) {
            return $this->sendError('Jugadora no trobada.');
        }
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora recuperada.');
    }

    // PUT /api/jugadores/{id}
    public function update(Request $request, Jugadora $jugadora)
    {
        $user = $request->user();

        // Permisos: Admin total, o Manager si la jugadora es de su equipo
        $esManagerDeSuEquipo = ($user->role === 'manager' && $user->team_id === $jugadora->equip_id);

        if ($user->role !== 'admin' && !$esManagerDeSuEquipo) {
            return $this->sendError('Unauthorized. No pots editar aquesta jugadora.', [], 403);
        }

        $jugadora->update($request->all());
        return $this->sendResponse(new JugadoraResource($jugadora), 'Jugadora actualitzada.');
    }

    // DELETE /api/jugadores/{id}
    public function destroy(Request $request, Jugadora $jugadora)
    {
        $user = $request->user();

        $esManagerDeSuEquipo = ($user->role === 'manager' && $user->team_id === $jugadora->equip_id);

        if ($user->role !== 'admin' && !$esManagerDeSuEquipo) {
            return $this->sendError('Unauthorized.', [], 403);
        }

        $jugadora->delete();
        return $this->sendResponse([], 'Jugadora eliminada (baixa).');
    }
}