@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">🏗️ Construir Nou Estadi</h2>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
                    <ul>@foreach ($errors->all() as $error) <li>• {{ $error }}</li> @endforeach</ul>
                </div>
            @endif

            <form action="{{ route('estadis.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-gray-700">Nom de l'Estadi</label>
                        <input type="text" name="nom" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Ciutat</label>
                        <input type="text" name="ciutat" class="w-full border-gray-300 rounded-md shadow-sm" required>
                    </div>
                    <div>
                        <label class="block font-bold text-gray-700">Capacitat (Espectadors)</label>
                        <input type="number" name="capacitat" class="w-full border-gray-300 rounded-md shadow-sm" min="100" required>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Inaugurar Estadi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection