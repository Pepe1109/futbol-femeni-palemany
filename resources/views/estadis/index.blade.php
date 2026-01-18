@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">🏟️ Infraestructures (Estadis)</h2>
                
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('estadis.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition">
                    + Nou Estadi
                </a>
                @endif
            </div>

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 m-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estadi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ciutat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aforament</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Accions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($estadis as $estadi)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                                {{ $estadi->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                {{ $estadi->ciutat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ number_format($estadi->capacitat, 0, ',', '.') }} pax
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('estadis.show', $estadi->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">👁️</a>
                                
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                    <a href="{{ route('estadis.edit', $estadi->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">✏️</a>
                                @endif

                                @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('estadis.destroy', $estadi->id) }}" method="POST" class="inline" onsubmit="return confirm('Segur que vols enderrocar aquest estadi?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">🗑️</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hi ha estadis construïts.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-200">
                {{ $estadis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection