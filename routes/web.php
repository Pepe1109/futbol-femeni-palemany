<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;
// Afegim el controlador de perfil que ve amb Breeze
use App\Http\Controllers\ProfileController; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirecció inicial a equips
Route::get('/', function () {
    return redirect()->route('equips.index');
});

// Ruta Dashboard (protegida) - Ve amb Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutes de Perfil d'Usuari (protegides) - Ve amb Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------- LES TEVES RUTES (EQUIPS, ESTADIS, ETC.) ----------

// Grup de rutes públiques (o pots protegir-les amb ->middleware('auth') si vols)
Route::middleware(['auth'])->group(function () {
    
    // Rutes per al component Livewire (Històric)
    Route::get('/historic', [PartitController::class, 'historic'])->name('partits.historic');

    // EQUIPS
    Route::resource('equips', EquipController::class);
    
    // ESTADIS
    Route::resource('estadis', EstadiController::class);
    
    // JUGADORES
    Route::resource('jugadores', JugadoraController::class);
    
    // PARTITS
    Route::resource('partits', PartitController::class);
});

// Carreguem les rutes d'autenticació de Breeze (login, register, etc.)
require __DIR__.'/auth.php';