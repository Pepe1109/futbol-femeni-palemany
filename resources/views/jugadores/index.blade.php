@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">
                    🏃‍♀️ Llistat de Jugadores
                </h2>
                
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                <a href="{{ route('jugadores.create') }}" class="inline-flex items-center px-4 py-2 bg-pink-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-pink-700 active:bg-pink-900 focus:outline-none focus:border-pink-900 focus:ring ring-pink-300 transition ease-in-out duration-150">
                    + Nova Jugadora
                </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jugadora</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posició</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Equip</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($jugadores as $jugadora)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center text-gray-600 font-bold">
                                        {{ $jugadora->dorsal ?? '#' }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $jugadora->nom }} {{ $jugadora->cognoms }}</div>
                                        <div class="text-xs text-gray-500">Naixement: {{ $jugadora->data_naixement ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $colors = [
                                        'Portera' => 'bg-yellow-100 text-yellow-800',
                                        'Defensa' => 'bg-blue-100 text-blue-800',
                                        'Migcampista' => 'bg-green-100 text-green-800',
                                        'Davantera' => 'bg-red-100 text-red-800',
                                    ];
                                    $class = $colors[$jugadora->posicio] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                    {{ $jugadora->posicio }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $jugadora->equip->nom ?? 'Sense Equip' }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('jugadores.show', $jugadora->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">👁️</a>
                                
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                    <a href="{{ route('jugadores.edit', $jugadora->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">✏️</a>
                                @endif

                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('jugadores.destroy', $jugadora->id) }}" method="POST" class="inline" onsubmit="return confirm('Segur que vols acomiadar aquesta jugadora?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">🗑️</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hi ha jugadores fitxades.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-200">
                {{ $jugadores->links() }}
            </div>
        </div>
    </div>
</div>
@endsection