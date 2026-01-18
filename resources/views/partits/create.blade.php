@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">⚽ Tauler de Partits</h2>
                
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('partits.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                    + Programar Partit
                </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Data</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Local</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Resultat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visitant</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($partits as $partit)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($partit->data)->format('d/m/Y H:i') }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-right font-bold text-gray-800">
                                {{ $partit->local->nom }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($partit->resultat)
                                    <span class="px-3 py-1 bg-gray-800 text-white rounded-lg font-mono font-bold tracking-widest">
                                        {{ $partit->resultat }}
                                    </span>
                                @else
                                    <span class="text-gray-400 font-bold">VS</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-left font-bold text-gray-800">
                                {{ $partit->visitant->nom }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <a href="{{ route('partits.show', $partit->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">👁️</a>
                                
                                {{-- Admin o Árbitro pueden editar --}}
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'arbitre')
                                    <a href="{{ route('partits.edit', $partit->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">✏️</a>
                                @endif

                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('partits.destroy', $partit->id) }}" method="POST" class="inline" onsubmit="return confirm('Cancel·lar el partit?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">🗑️</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hi ha partits programats.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-200">
                {{ $partits->links() }}
            </div>
        </div>
    </div>
</div>
@endsection