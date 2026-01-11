@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Llistat de Jugadores</h2>
        <a href="{{ route('jugadores.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Nova Jugadora</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="px-4 py-2">Nom</th>
                    <th class="px-4 py-2">Posició</th>
                    <th class="px-4 py-2">Equip</th>
                    <th class="px-4 py-2">Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jugadores as $jugadora)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $jugadora->nom }}</td>
                        <td class="px-4 py-2">{{ $jugadora->posicio ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $jugadora->equip->nom ?? 'Sense equip' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('jugadores.edit', $jugadora->id) }}" class="text-blue-600">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="p-4">
            {{ $jugadores->links() }}
        </div>
    </div>
@endsection