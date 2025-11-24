@extends('layouts.app')

@section('content')
<h2>Jugadoras</h2>

<a href="{{ route('jugadores.create') }}" class="btn btn-primary">+ Nova jugadora</a>

<table class="table">
    <thead>
    <tr>
        <th>Nom</th>
        <th>Equip</th>
        <th>Posició</th>
        <th>Accions</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($jugadores as $jugadora)
        <tr>
            <td>{{ $jugadora->nom }}</td>
            <td>{{ $jugadora->equip->nom ?? '-' }}</td>
            <td>{{ $jugadora->posicio }}</td>
            <td>
                <a href="{{ route('jugadores.show', $jugadora->id) }}" class="btn btn-sm btn-info">Veure</a>
                <a href="{{ route('jugadores.edit', $jugadora->id) }}" class="btn btn-sm btn-warning">Editar</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">No hi ha jugadores.</td>
        </tr>
    @endforelse
    </tbody>
</table>
@endsection
