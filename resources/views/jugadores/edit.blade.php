@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar: {{ $jugadora->nom }}</h2>

            <form action="{{ route('jugadores.update', $jugadora->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Nom</label>
                        <input type="text" name="nom" value="{{ $jugadora->nom }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Cognoms</label>
                        <input type="text" name="cognoms" value="{{ $jugadora->cognoms }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Equip</label>
                        <select name="equip_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}" {{ $jugadora->equip_id == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Posició</label>
                        <select name="posicio" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($posicions as $pos)
                                <option value="{{ $pos }}" {{ $jugadora->posicio == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Dorsal</label>
                        <input type="number" name="dorsal" value="{{ $jugadora->dorsal }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Data Naixement</label>
                        <input type="date" name="data_naixement" value="{{ $jugadora->data_naixement }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Editar: {{ $jugadora->nom }}</h2>

            <form action="{{ route('jugadores.update', $jugadora->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Nom</label>
                        <input type="text" name="nom" value="{{ $jugadora->nom }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Cognoms</label>
                        <input type="text" name="cognoms" value="{{ $jugadora->cognoms }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Equip</label>
                        <select name="equip_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}" {{ $jugadora->equip_id == $equip->id ? 'selected' : '' }}>{{ $equip->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Posició</label>
                        <select name="posicio" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($posicions as $pos)
                                <option value="{{ $pos }}" {{ $jugadora->posicio == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Dorsal</label>
                        <input type="number" name="dorsal" value="{{ $jugadora->dorsal }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Data Naixement</label>
                        <input type="date" name="data_naixement" value="{{ $jugadora->data_naixement }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection