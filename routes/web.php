<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\PartitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// GRUPO PRINCIPAL: Solo gente logueada
Route::middleware('auth')->group(function () {
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- ZONA VISIBLE PARA TODOS (Ver Listas y Detalles) ---
    Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
    Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
    Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
    
    // PARTITS: Index, Històric y SHOW (Esta faltaba)
    Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
    Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');
    Route::get('/partits/{partit}', [PartitController::class, 'show'])->name('partits.show'); // <--- ¡AQUÍ ESTÁ LA SOLUCIÓN!

    // --- ZONA ADMIN (CREAR Y BORRAR) ---
    // Solo el jefe puede crear/borrar estadios, equipos y partidos
    Route::middleware('role:admin')->group(function () {
        Route::resource('equips', EquipController::class)->only(['create', 'store', 'destroy']);
        Route::resource('estadis', EstadiController::class)->only(['create', 'store', 'destroy']);
        Route::resource('partits', PartitController::class)->only(['create', 'store', 'destroy']);
    });

    // --- ZONA DE TRABAJO (MANAGER Y ADMIN) ---
    // Editar cosas existentes
    Route::resource('equips', EquipController::class)->only(['edit', 'update', 'show']);
    Route::resource('estadis', EstadiController::class)->only(['edit', 'update', 'show']);
    
    // Jugadores: CRUD completo (El manager hace todo con ellas)
    Route::resource('jugadores', JugadoraController::class);

    // --- ZONA ÁRBITRO (PARTIDOS) ---
    // El árbitro y el admin pueden poner resultados
    Route::get('/partits/{partit}/edit', [PartitController::class, 'edit'])->name('partits.edit');
    Route::put('/partits/{partit}', [PartitController::class, 'update'])->name('partits.update');
});

require __DIR__.'/auth.php';