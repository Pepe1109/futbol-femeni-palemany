@extends('layouts.app')

@section('content')
<h1>Detalls del Partit</h1>

@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

<p><strong>Local:</strong> {{ $partit->local?->nom ?? '—' }}</p>
<p><strong>Visitant:</strong> {{ $partit->visitant?->nom ?? '—' }}</p>
<p><strong>Data:</strong> {{ $partit->data }}</p>
<p><strong>Resultat:</strong> {{ $partit->resultat ?? '—' }}</p>

<a href="{{ route('partits.index') }}">Tornar</a> |
<a href="{{ route('partits.edit', $partit->id) }}">Editar</a>
@endsection
