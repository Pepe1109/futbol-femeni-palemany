@extends('layouts.app')

@section('content')
<h1>Editar Partit</h1>

@if(session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif

<form action="{{ route('partits.update', $partit->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Equip Local:</label>
    <select name="local_id" required>
        @foreach($equips as $equip)
            <option value="{{ $equip->id }}" {{ $equip->id == $partit->local_id ? 'selected' : '' }}>
                {{ $equip->nom }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Equip Visitant:</label>
    <select name="visitant_id" required>
        @foreach($equips as $equip)
            <option value="{{ $equip->id }}" {{ $equip->id == $partit->visitant_id ? 'selected' : '' }}>
                {{ $equip->nom }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Data:</label>
    <input type="date" name="data" value="{{ $partit->data->format('Y-m-d') }}" required>
    <br><br>

    <label>Resultat:</label>
    <input type="text" name="resultat" value="{{ $partit->resultat }}">
    <br><br>

    <button type="submit">Guardar</button>
    <a href="{{ route('partits.show', $partit->id) }}">Tornar</a>
</form>
@endsection
