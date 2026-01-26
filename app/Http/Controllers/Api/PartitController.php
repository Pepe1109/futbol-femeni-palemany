<?php

namespace App\Http\Controllers\Api;

use App\Models\Partit;
use Illuminate\Http\Request;
use App\Http\Resources\PartitResource;
use Illuminate\Support\Facades\Validator;

class PartitController extends BaseController
{
    // GET /api/partits
    public function index()
    {
        // Cargamos relaciones para que el Resource tenga nombres de equipos
        $partits = Partit::with(['local', 'visitant'])->paginate(10);
        return $this->sendResponse(PartitResource::collection($partits), 'Llistat de partits recuperat.');
    }

    // POST /api/partits (Solo Admin programa partidos)
    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized. Només l\'admin pot programar partits.', [], 403);
        }

        $validator = Validator::make($request->all(), [
            'local_id' => 'required|exists:equips,id',
            'visitant_id' => 'required|exists:equips,id|different:local_id',
            'data' => 'required|date',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $partit = Partit::create($request->all());
        return $this->sendResponse(new PartitResource($partit), 'Partit programat correctament.');
    }

    // GET /api/partits/{id}
    public function show($id)
    {
        $partit = Partit::with(['local', 'visitant'])->find($id);
        if (is_null($partit)) {
            return $this->sendError('Partit no trobat.');
        }
        return $this->sendResponse(new PartitResource($partit), 'Partit recuperat.');
    }

    // PUT /api/partits/{id} (Admin TOTAL / Árbitro SOLO RESULTADO)
    public function update(Request $request, Partit $partit)
    {
        $user = $request->user();

        // CASO 1: Es ÁRBITRO
        if ($user->role === 'arbitre') {
            // Validamos que solo envíe el resultado
            $validator = Validator::make($request->all(), [
                'resultat' => 'required|string', // Ej: "2-1"
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }

            // Actualizamos SOLO el resultado, ignoramos fecha o equipos si los envía
            $partit->update(['resultat' => $request->resultat]);
            
            return $this->sendResponse(new PartitResource($partit), 'Resultat actualitzat per l\'àrbitre.');
        }

        // CASO 2: Es ADMIN
        if ($user->role === 'admin') {
            $partit->update($request->all());
            return $this->sendResponse(new PartitResource($partit), 'Partit modificat per l\'admin.');
        }

        // CASO 3: Ni uno ni otro
        return $this->sendError('Unauthorized', [], 403);
    }

    // DELETE /api/partits/{id} (Solo Admin)
    public function destroy(Request $request, Partit $partit)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $partit->delete();
        return $this->sendResponse([], 'Partit eliminat.');
    }
}