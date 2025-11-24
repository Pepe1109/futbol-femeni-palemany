@extends('layouts.app')

@section('content')
<h1>Llista de Partits</h1>

@if(session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Local</th>
        <th>Visitant</th>
        <th>Data</th>
        <th>Accions</th>
    </tr>
    @foreach($partits as $partit)
        <tr>
            <td>{{ $partit->id }}</td>
            <td>{{ $partit->local?->nom ?? '—' }}</td>
            <td>{{ $partit->visitant?->nom ?? '—' }}</td>
            <td>{{ $partit->data }}</td>
            <td>
                <a href="{{ route('partits.show', $partit->id) }}">Veure</a> |
                <a href="{{ route('partits.edit', $partit->id) }}">Editar</a>
            </td>
        </tr>
    @endforeach
</table>
@endsection
