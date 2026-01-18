@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        🛡️ Ficha del Equip: {{ $equip->nom }}
                    </h2>
                    <a href="{{ route('equips.index') }}" class="text-gray-600 hover:text-gray-900 font-bold">
                        &larr; Tornar a la llista
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                        <h3 class="font-bold text-lg mb-4 text-indigo-700">Dades Generals</h3>
                        <p><strong>🏙️ Ciutat:</strong> {{ $equip->ciutat }}</p>
                        <p class="mt-2"><strong>🏟️ Estadi:</strong> {{ $equip->estadi->nom ?? 'Sense estadi assignat' }}</p>
                        <p class="mt-2"><strong>🏆 Títols:</strong> {{ $equip->titols }}</p>
                        
                        <div class="mt-6 border-t pt-4">
                            <h4 class="font-bold text-gray-700 mb-2">Últims 5 Partits:</h4>
                            <div class="flex space-x-2">
                                @foreach($equip->forma as $res)
                                    @if($res == 'G')
                                        {{-- VICTORIA --}}
                                        <div class="h-8 w-8 rounded-full bg-green-600 text-white flex items-center justify-center font-bold shadow-md border border-green-800">G</div>
                                    @elseif($res == 'E')
                                        {{-- EMPATE --}}
                                        <div class="h-8 w-8 rounded-full bg-gray-800 text-white flex items-center justify-center font-bold shadow-md border border-black">E</div>
                                    @else
                                        {{-- DERROTA --}}
                                        <div class="h-8 w-8 rounded-full bg-red-600 text-white flex items-center justify-center font-bold shadow-md border border-red-800">D</div>
                                    @endif
                                @endforeach
                                @if(empty($equip->forma))
                                    <p class="text-sm text-gray-400 italic">No hi ha partits registrats.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg shadow-inner">
                        <h3 class="font-bold text-lg mb-4 text-pink-700">Plantilla ({{ $equip->jugadores->count() }})</h3>
                        
                        @if($equip->jugadores->count() > 0)
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($equip->jugadores as $jugadora)
                                    <li class="text-gray-700">
                                        <span class="font-semibold">{{ $jugadora->nom }} {{ $jugadora->cognoms }}</span>
                                        <span class="text-sm text-gray-500">- {{ $jugadora->posicio }} ({{ $jugadora->dorsal }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 italic">No hi ha jugadores registrades en aquest equip.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection