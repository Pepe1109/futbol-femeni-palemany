<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\PartitController;
use App\Http\Controllers\ClassificacioController;
// --- IMPORTS NECESARIOS PARA EL DASHBOARD ---
use App\Models\Equip;
use App\Models\Jugadora;
use App\Models\Partit;
// --------------------------------------------
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// --- DASHBOARD CON ESTADÍSTICAS ---
Route::get('/dashboard', function () {
    // 1. Contamos cuántos hay de cada
    $totalEquips = Equip::count();
    $totalJugadoras = Jugadora::count();
    // Solo contamos partidos jugados (que tienen resultado)
    $totalPartits = Partit::whereNotNull('resultat')->count(); 
    
    // 2. Buscamos el partido más cercano en el futuro
    $proximPartit = Partit::with(['local', 'visitant'])
                    ->where('data', '>', now())
                    ->orderBy('data', 'asc')
                    ->first();

    return view('dashboard', compact('totalEquips', 'totalJugadoras', 'totalPartits', 'proximPartit'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- CLASIFICACIÓN ---
    Route::get('/classificacio', [ClassificacioController::class, 'index'])->name('classificacio.index');

    // --- LISTAS PÚBLICAS (Index) ---
    Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
    Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
    Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
    
    // PARTITS (Index y Histórico)
    Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
    Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');

    // ====================================================================
    //  ⚡ IMPORTANTE: LAS RUTAS 'CREATE' VAN ANTES QUE 'SHOW' ⚡
    // ====================================================================

    // --- ZONA ADMIN (CREAR Y BORRAR) ---
    Route::middleware('role:admin')->group(function () {
        Route::resource('equips', EquipController::class)->only(['create', 'store', 'destroy']);
        Route::resource('estadis', EstadiController::class)->only(['create', 'store', 'destroy']);
        Route::resource('partits', PartitController::class)->only(['create', 'store', 'destroy']);
    });

    // --- ZONA VISUALIZAR (SHOW) ---
    Route::get('/partits/{partit}', [PartitController::class, 'show'])->name('partits.show');
    
    // --- ZONA DE TRABAJO (MANAGER Y ADMIN) ---
    Route::resource('equips', EquipController::class)->only(['edit', 'update', 'show']);
    Route::resource('estadis', EstadiController::class)->only(['edit', 'update', 'show']);
    Route::resource('jugadores', JugadoraController::class);

    // --- ZONA ÁRBITRO (PARTIDOS) ---
    Route::get('/partits/{partit}/edit', [PartitController::class, 'edit'])->name('partits.edit');
    Route::put('/partits/{partit}', [PartitController::class, 'update'])->name('partits.update');
});

require __DIR__.'/auth.php';