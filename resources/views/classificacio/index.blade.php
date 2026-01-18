@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-3xl font-black text-gray-800 mb-6 text-center">
                    🏆 Classificació de la Lliga
                </h2>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="bg-gray-800 text-white uppercase text-xs tracking-wider">
                                <th class="px-4 py-3 text-center">Pos</th>
                                <th class="px-6 py-3 text-left">Equip</th>
                                <th class="px-4 py-3 text-center font-bold text-yellow-400 text-base">PTS</th>
                                <th class="px-4 py-3 text-center">PJ</th>
                                <th class="px-4 py-3 text-center hidden sm:table-cell">PG</th>
                                <th class="px-4 py-3 text-center hidden sm:table-cell">PE</th>
                                <th class="px-4 py-3 text-center hidden sm:table-cell">PP</th>
                                <th class="px-4 py-3 text-center text-gray-400 hidden md:table-cell">GF</th>
                                <th class="px-4 py-3 text-center text-gray-400 hidden md:table-cell">GC</th>
                                <th class="px-4 py-3 text-center font-bold hidden md:table-cell">DG</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php $posicio = 1; @endphp
                            @foreach ($classificacio as $equip)
                            
                            {{-- Lógica de Colores según posición --}}
                            @php
                                $rowClass = '';
                                $posClass = 'bg-gray-100 text-gray-600'; // Normal

                                if ($posicio === 1) {
                                    $rowClass = 'bg-yellow-50 border-l-4 border-yellow-400';
                                    $posClass = 'bg-yellow-400 text-white font-bold shadow-md'; // Campeón
                                } elseif ($posicio <= 4) {
                                    $rowClass = 'border-l-4 border-blue-400';
                                    $posClass = 'bg-blue-500 text-white font-bold'; // Champions
                                } elseif ($loop->remaining < 3) {
                                    $rowClass = 'bg-red-50 border-l-4 border-red-500';
                                    $posClass = 'bg-red-500 text-white font-bold'; // Descenso
                                }
                            @endphp

                            <tr class="hover:bg-gray-50 transition {{ $rowClass }}">
                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full {{ $posClass }}">
                                        {{ $posicio++ }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="text-sm font-bold text-gray-900">{{ $equip->nom }}</div>
                                    </div>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-center">
                                    <span class="text-xl font-black text-gray-900">{{ $equip->pts }}</span>
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-600">
                                    {{ $equip->pj }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-green-600 font-semibold hidden sm:table-cell">
                                    {{ $equip->pg }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-500 hidden sm:table-cell">
                                    {{ $equip->pe }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-red-500 hidden sm:table-cell">
                                    {{ $equip->pp }}
                                </td>

                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-400 hidden md:table-cell">
                                    {{ $equip->gf }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm text-gray-400 hidden md:table-cell">
                                    {{ $equip->gc }}
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-bold text-gray-800 hidden md:table-cell">
                                    {{ $equip->dg > 0 ? '+'.$equip->dg : $equip->dg }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 flex space-x-4 text-xs text-gray-500 justify-center">
                    <div class="flex items-center"><span class="w-3 h-3 bg-yellow-400 rounded-full mr-1"></span> Campió</div>
                    <div class="flex items-center"><span class="w-3 h-3 bg-blue-500 rounded-full mr-1"></span> Champions</div>
                    <div class="flex items-center"><span class="w-3 h-3 bg-red-500 rounded-full mr-1"></span> Descens</div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection