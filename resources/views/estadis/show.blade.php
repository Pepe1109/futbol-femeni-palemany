@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="relative h-48 bg-gray-800 flex items-center justify-center">
                <h1 class="text-4xl text-white font-bold tracking-wider">{{ $estadi->nom }}</h1>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">📍 Detalls Tècnics</h3>
                        <p class="text-gray-600 text-lg">🏙️ <strong>Ciutat:</strong> {{ $estadi->ciutat }}</p>
                        <p class="text-gray-600 text-lg mt-2">👥 <strong>Capacitat:</strong> {{ number_format($estadi->capacitat, 0, ',', '.') }} espectadors</p>
                    </div>

                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="text-xl font-bold text-blue-800 mb-4">⚽ Equip Local</h3>
                        @if($estadi->equips->count() > 0)
                            <ul class="space-y-2">
                                @foreach($estadi->equips as $equip)
                                    <li class="flex items-center space-x-2">
                                        <span class="text-2xl">🛡️</span>
                                        <a href="{{ route('equips.show', $equip->id) }}" class="text-lg font-semibold text-blue-600 hover:underline">
                                            {{ $equip->nom }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">Aquest estadi no té cap equip assignat actualment.</p>
                        @endif
                    </div>
                </div>

                <div class="mt-8 flex justify-center">
                    <a href="{{ route('estadis.index') }}" class="text-gray-500 hover:text-gray-900 font-bold border-b-2 border-transparent hover:border-gray-900 transition">
                        Tornar al llistat
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection