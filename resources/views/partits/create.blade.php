@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">📅 Programar Nou Partit</h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                    <ul>@foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <form action="{{ route('partits.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Equip Local</label>
                        <select name="local_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700">Equip Visitant</label>
                        <select name="visitant_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            @foreach($equips as $equip)
                                <option value="{{ $equip->id }}">{{ $equip->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-gray-700">Data i Hora</label>
                        <input type="datetime-local" name="data" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    
                    <div>
                        <label class="block font-bold text-gray-700">Resultat (Opcional)</label>
                        <input type="text" name="resultat" placeholder="Ex: 0-0" class="w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Guardar Partit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection