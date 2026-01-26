<?php
namespace App\Http\Controllers\Api;

use App\Models\Equip;
use Illuminate\Http\Request;
use App\Http\Resources\EquipResource; // El recurso JSON
use Illuminate\Support\Facades\Gate;  // La seguridad
use Illuminate\Support\Facades\Validator;

class EquipController extends BaseController
{
    // GET /api/equips (Público)
    public function index()
    {
        $equips = Equip::paginate(10); // Paginación
        return $this->sendResponse(EquipResource::collection($equips), 'Equips retrieved successfully.');
    }

    // POST /api/equips (Solo Admin)
    public function store(Request $request)
    {
        // 1. Check Permisos (Solo Admin puede crear)
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        // 2. Validación
        $validator = Validator::make($request->all(), [
            'nom' => 'required',
            'ciutat' => 'required',
            'estadi_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        // 3. Crear
        $equip = Equip::create($request->all());
        return $this->sendResponse(new EquipResource($equip), 'Equip created successfully.');
    }

    // GET /api/equips/{id} (Público)
    public function show($id)
    {
        $equip = Equip::find($id);
        if (is_null($equip)) {
            return $this->sendError('Equip not found.');
        }
        return $this->sendResponse(new EquipResource($equip), 'Equip retrieved successfully.');
    }

    // PUT /api/equips/{id} (Admin o Manager Propietario)
    public function update(Request $request, Equip $equip)
    {
        // 1. Check Seguridad (Usamos la Policy que creamos ayer)
        if (!Gate::allows('update', $equip)) {
            return $this->sendError('Unauthorized. No tens permís per editar aquest equip.', [], 403);
        }

        // 2. Validación y Update
        $input = $request->all();
        $equip->update($input);

        return $this->sendResponse(new EquipResource($equip), 'Equip updated successfully.');
    }

    // DELETE /api/equips/{id} (Solo Admin)
    public function destroy(Request $request, Equip $equip)
    {
        if ($request->user()->role !== 'admin') {
            return $this->sendError('Unauthorized', [], 403);
        }

        $equip->delete();
        return $this->sendResponse([], 'Equip deleted successfully.');
    }
}