@extends('layouts.app')

@section('content')
    <h2>Estadis</h2>

    <a href="{{ route('estadis.create') }}" class="btn btn-primary">+ Nou estadi</a>

    <table class="table">
        <thead>
        <tr>
            <th>Nom</th>
            <th>Ciutat</th>
            <th>Capacitat</th>
            <th>Equip principal</th>
            <th>Accions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($estadis as $estadi)
            <tr>
                <td>{{ $estadi->nom }}</td>
                <td>{{ $estadi->ciutat }}</td>
                <td>{{ $estadi->capacitat }}</td>
                <td>{{ $estadi->equip->nom ?? '-' }}</td>
                <td>
                    <a href="{{ route('estadis.show', $estadi->id) }}" class="btn btn-info btn-sm">Veure</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No hi ha estadis.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
@endsection
