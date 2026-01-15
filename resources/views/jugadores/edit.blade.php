@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Editar Jugadora</h2>

        <form action="{{ route('jugadores.update', $jugadora->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom', $jugadora->nom) }}" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="cognoms" class="block text-sm font-medium text-gray-700">Cognoms</label>
                <input type="text" name="cognoms" id="cognoms" value="{{ old('cognoms', $jugadora->cognoms) }}" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('cognoms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="equip_id" class="block text-sm font-medium text-gray-700">Equip</label>
                <select name="equip_id" id="equip_id" required 
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach($equips as $equip)
                        <option value="{{ $equip->id }}" {{ old('equip_id', $jugadora->equip_id) == $equip->id ? 'selected' : '' }}>
                            {{ $equip->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="posicio" class="block text-sm font-medium text-gray-700">Posició</label>
                <select name="posicio" id="posicio" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @foreach ($posicions as $pos)
                        <option value="{{ $pos }}" {{ old('posicio', $jugadora->posicio) === $pos ? 'selected' : '' }}>
                            {{ $pos }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label for="dorsal" class="block text-sm font-medium text-gray-700">Dorsal</label>
                <input type="number" name="dorsal" id="dorsal" value="{{ old('dorsal', $jugadora->dorsal) }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">
                Actualitzar Jugadora
            </button>
        </form>
    </div>
@endsection