@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estadi: {{ $estadi->nom }}</h1>

    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nom:</strong> {{ $estadi->nom }}</p>
            <p><strong>Capacitat:</strong> {{ $estadi->capacitat }}</p>
            <p><strong>Ciutat:</strong> {{ $estadi->ciutat }}</p>

            @if ($estadi->imatge)
                <p><strong>Imatge:</strong></p>
                <img src="{{ asset('storage/' . $estadi->imatge) }}" width="300">
            @endif
        </div>
    </div>

    <a href="{{ route('estadis.index') }}" class="btn btn-secondary mt-3">Tornar</a>
</div>
@endsection
