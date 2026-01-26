<?php

namespace App\Http\Controllers\Api;

use App\Models\Estadi;
use Illuminate\Http\Request;
use App\Http\Resources\EstadiResource;
use Illuminate\Support\Facades\Validator;

class EstadiController extends BaseController
{
    // GET /api/estadis
    public function index()
    {
        $estadis = Estadi::all();
        return $this->sendResponse(EstadiResource::collection($estadis), 'Llistat d\'estadis recuperat.');
    }

    // POST /api/estadis (Solo Admin)
    public function store(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'ciutat' => 'required|string',
            'capacitat' => 'required|integer'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $estadi = Estadi::create($request->all());
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi creat correctament.');
    }

    // GET /api/estadis/{id}
    public function show($id)
    {
        $estadi = Estadi::find($id);
        if (is_null($estadi)) {
            return $this->sendError('Estadi no trobat.');
        }
        return $this->sendResponse(new EstadiResource($estadi), 'Estadi recuperat.');
    }

    // PUT /api/estadis/{id} (Solo Admin)
    public function update(Request $request, Estadi $estadi)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $input = $request->all();
        $estadi->update($input);

        return $this->sendResponse(new EstadiResource($estadi), 'Estadi actualitzat correctament.');
    }

    // DELETE /api/estadis/{id} (Solo Admin)
    public function destroy(Request $request, Estadi $estadi)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $estadi->delete();
        return $this->sendResponse([], 'Estadi eliminat.');
    }
}