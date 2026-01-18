@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg text-center p-10">
            
            <h3 class="text-gray-500 uppercase tracking-widest font-bold mb-8">
                {{ \Carbon\Carbon::parse($partit->data)->format('d F Y - H:i') }}
            </h3>

            <div class="flex items-center justify-center space-x-8 md:space-x-16">
                <div class="flex-1 text-right">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900">{{ $partit->local->nom }}</h2>
                    <p class="text-gray-500 mt-2 font-bold text-xl">LOCAL</p>
                </div>

                <div class="bg-gray-900 text-white px-8 py-4 rounded-lg shadow-2xl">
                    <span class="text-5xl md:text-7xl font-mono font-bold">
                        {{ $partit->resultat ?? 'VS' }}
                    </span>
                </div>

                <div class="flex-1 text-left">
                    <h2 class="text-3xl md:text-5xl font-black text-gray-900">{{ $partit->visitant->nom }}</h2>
                    <p class="text-gray-500 mt-2 font-bold text-xl">VISITANT</p>
                </div>
            </div>

            <div class="mt-12">
                <a href="{{ route('partits.index') }}" class="text-gray-600 hover:text-gray-900 font-bold border-b border-gray-400 pb-1">
                    &larr; Tornar als partits
                </a>
            </div>

        </div>
    </div>
</div>
@endsection