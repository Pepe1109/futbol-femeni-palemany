@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800">
                    ⚽ Llistat d'Equips
                </h2>
                
                {{-- Solo el Admin ve el botón de crear (protegido por rol en la vista) --}}
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('equips.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                    + Nou Equip
                </a>
                @endif
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom de l'Equip
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ciutat
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estadi
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Títols
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Accions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($equips as $equip)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                #{{ $equip->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $equip->nom }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $equip->ciutat }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $equip->estadi->nom ?? 'Sense estadi' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $equip->titols }} 🏆
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('equips.show', $equip->id) }}" class="text-blue-600 hover:text-blue-900" title="Veure">
                                        👁️
                                    </a>
                                    
                                    {{-- Botón Editar: Admin o Manager --}}
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager')
                                    <a href="{{ route('equips.edit', $equip->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                        ✏️
                                    </a>
                                    @endif

                                    {{-- Botón Borrar: Solo Admin --}}
                                    @if(auth()->user()->role === 'admin')
                                    <form action="{{ route('equips.destroy', $equip->id) }}" method="POST" class="inline" onsubmit="return confirm('Estàs segur de voler esborrar aquest equip?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Esborrar">
                                            🗑️
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No hi ha equips registrats encara.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="p-4 border-t border-gray-200">
                {{ $equips->links() }}
            </div>
        </div>
    </div>
</div>
@endsection