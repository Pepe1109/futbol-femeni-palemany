@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Actualitzar Partit/Resultat</h2>

            <form action="{{ route('partits.update', $partit->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Equip Local</label>
                        <select name="local_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}" {{ $partit->local_id == $equip->id ? 'selected' : '' }}>
                                    {{ $equip->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700">Equip Visitant</label>
                        <select name="visitant_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}" {{ $partit->visitant_id == $equip->id ? 'selected' : '' }}>
                                    {{ $equip->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700">Data</label>
                        <input type="datetime-local" name="data" value="{{ \Carbon\Carbon::parse($partit->data)->format('Y-m-d\TH:i') }}" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700 text-blue-600">Marcador Final</label>
                        <input type="text" name="resultat" value="{{ $partit->resultat }}" placeholder="Ex: 2-1" class="w-full border-blue-300 rounded-md shadow-sm ring ring-blue-100">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Actualizar Marcador</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection