@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Jugadora: {{ $jugadora->nom }}</h1>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nom:</strong> {{ $jugadora->nom }}</p>
            <p><strong>Posició:</strong> {{ $jugadora->posicio }}</p>
            <p><strong>Dorsal:</strong> {{ $jugadora->dorsal }}</p>
            <p><strong>Edat:</strong> {{ $jugadora->edat }}</p>

            <p><strong>Equip:</strong>
                <a href="{{ route('equips.show', $jugadora->equip->id) }}">
                    {{ $jugadora->equip->nom }}
                </a>
            </p>

            @if ($jugadora->foto)
                <p><strong>Foto:</strong></p>
                <img src="{{ asset('storage/' . $jugadora->foto) }}" width="250">
            @endif
        </div>
    </div>

    <a href="{{ route('jugadores.index') }}" class="btn btn-secondary mt-3">Tornar</a>
</div>
@endsection
