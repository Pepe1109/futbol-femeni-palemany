@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            
            <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar Equip: {{ $equip->nom }}</h2>

            {{-- Mostrar errores de validación si los hay --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('equips.update', $equip->id) }}" method="POST">
                @csrf
                @method('PUT') {{-- ¡IMPORTANTE: Método PUT para actualizar! --}}

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="nom">Nom de l'Equip</label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $equip->nom) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="ciutat">Ciutat</label>
                    <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat', $equip->ciutat) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="estadi_id">Estadi</label>
                    <select name="estadi_id" id="estadi_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 bg-white focus:outline-none focus:shadow-outline">
                        <option value="">-- Selecciona un estadi --</option>
                        @foreach($estadis as $estadi)
                            <option value="{{ $estadi->id }}" {{ (old('estadi_id', $equip->estadi_id) == $estadi->id) ? 'selected' : '' }}>
                                {{ $estadi->nom }} (Capacitat: {{ $estadi->capacitat }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2" for="titols">Títols</label>
                    <input type="number" name="titols" id="titols" value="{{ old('titols', $equip->titols) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="0">
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        💾 Guardar Canvis
                    </button>
                    <a href="{{ route('equips.index') }}" class="inline-block align-baseline font-bold text-sm text-gray-500 hover:text-gray-800">
                        Cancel·lar
                    </a>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection