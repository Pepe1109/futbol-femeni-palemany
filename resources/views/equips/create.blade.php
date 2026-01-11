@extends('layouts.app')

@section('title', 'Crear Equip')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-center">Crear Nou Equip</h2>

    <form action="{{ route('equips.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom de l'Equip:</label>
            <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('nom')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ciutat" class="block text-sm font-medium text-gray-700 mb-1">Ciutat:</label>
            <input type="text" name="ciutat" id="ciutat" value="{{ old('ciutat') }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label for="estadi_id" class="block text-sm font-medium text-gray-700 mb-1">Estadi:</label>
            <select name="estadi_id" id="estadi_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                <option value="">Sense estadi</option>
                {{-- @foreach($estadis as $estadi)
                    <option value="{{ $estadi->id }}">{{ $estadi->nom }}</option>
                @endforeach --}}
            </select>
        </div>

        <div class="mb-4">
            <label for="escut" class="block text-sm font-medium text-gray-700 mb-1">Escut (Imatge):</label>
            <input type="file" name="escut" id="escut" accept="image/*"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('escut')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
            Crear Equip
        </button>
    </form>
</div>
@endsection