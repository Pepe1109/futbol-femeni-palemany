@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-8">
            <div class="flex items-center space-x-6">
                <div class="h-32 w-32 bg-gray-200 rounded-full flex items-center justify-center text-4xl font-bold text-gray-500">
                    {{ $jugadora->dorsal ?? '#' }}
                </div>
                
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ $jugadora->nom }} {{ $jugadora->cognoms }}</h2>
                    <p class="text-xl text-pink-600 font-semibold">{{ $jugadora->posicio }} - {{ $jugadora->equip->nom }}</p>
                    
                    <div class="mt-4 grid grid-cols-2 gap-4 text-gray-600">
                        <p>🎂 <strong>Naixement:</strong> {{ $jugadora->data_naixement ?? 'Desconeguda' }}</p>
                        <p>👕 <strong>Dorsal:</strong> {{ $jugadora->dorsal }}</p>
                        <p>🏟️ <strong>Estadi:</strong> {{ $jugadora->equip->estadi->nom ?? 'Sense estadi' }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('jugadores.index') }}" class="text-gray-600 hover:text-gray-900 font-bold">&larr; Tornar al llistat</a>
            </div>
        </div>
    </div>
</div>
@endsection