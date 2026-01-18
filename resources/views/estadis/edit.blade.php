@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">🛠️ Reformar: {{ $estadi->nom }}</h2>

            <form action="{{ route('estadis.update', $estadi->id) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Nom</label>
                        <input type="text" name="nom" value="{{ $estadi->nom }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Ciutat</label>
                        <input type="text" name="ciutat" value="{{ $estadi->ciutat }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Capacitat</label>
                        <input type="number" name="capacitat" value="{{ $estadi->capacitat }}" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Guardar Reformes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection