@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Panell de Control') }}
    </h2>
@endsection

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                👋 Hola, <strong>{{ Auth::user()->name }}</strong>! Benvingut al gestor de la Lliga Femenina.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 uppercase text-xs font-bold tracking-wider">Equips inscrits</p>
                        <p class="text-4xl font-bold mt-2">{{ $totalEquips }}</p>
                    </div>
                    <div class="text-5xl opacity-30">🛡️</div>
                </div>
                <div class="mt-4 text-sm text-blue-200">
                    <a href="{{ route('equips.index') }}" class="hover:text-white hover:underline">Veure llista &rarr;</a>
                </div>
            </div>

            <div class="bg-pink-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 uppercase text-xs font-bold tracking-wider">Jugadores fitxades</p>
                        <p class="text-4xl font-bold mt-2">{{ $totalJugadoras }}</p>
                    </div>
                    <div class="text-5xl opacity-30">🏃‍♀️</div>
                </div>
                <div class="mt-4 text-sm text-pink-200">
                    <a href="{{ route('jugadores.index') }}" class="hover:text-white hover:underline">Veure llista &rarr;</a>
                </div>
            </div>

            <div class="bg-green-600 rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 uppercase text-xs font-bold tracking-wider">Partits Jugats</p>
                        <p class="text-4xl font-bold mt-2">{{ $totalPartits }}</p>
                    </div>
                    <div class="text-5xl opacity-30">⚽</div>
                </div>
                <div class="mt-4 text-sm text-green-200">
                    <a href="{{ route('partits.historic') }}" class="hover:text-white hover:underline">Veure resultats &rarr;</a>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-700">
                <h3 class="text-lg font-bold text-white">📅 Pròxim Partit Programat</h3>
            </div>
            <div class="p-8 text-center">
                @if($proximPartit)
                    <div class="flex flex-col md:flex-row items-center justify-center gap-8 text-white">
                        <div class="text-right flex-1">
                            <span class="text-2xl font-bold block">{{ $proximPartit->local->nom }}</span>
                            <span class="text-sm text-gray-400">LOCAL</span>
                        </div>

                        <div class="bg-gray-700 px-6 py-3 rounded-lg">
                            <span class="text-3xl font-mono font-bold">VS</span>
                            <div class="text-xs text-yellow-400 mt-1 font-bold uppercase">
                                {{ \Carbon\Carbon::parse($proximPartit->data)->format('d M - H:i') }}h
                            </div>
                        </div>

                        <div class="text-left flex-1">
                            <span class="text-2xl font-bold block">{{ $proximPartit->visitant->nom }}</span>
                            <span class="text-sm text-gray-400">VISITANT</span>
                        </div>
                    </div>
                    <div class="mt-8">
                        <a href="{{ route('partits.index') }}" class="inline-block bg-yellow-500 hover:bg-yellow-400 text-gray-900 font-bold py-2 px-6 rounded transition">
                            Veure Calendari
                        </a>
                    </div>
                @else
                    <p class="text-gray-400 text-lg">No hi ha partits programats pròximament.</p>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('partits.create') }}" class="mt-4 inline-block bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                            + Programar Partit
                        </a>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>
@endsection