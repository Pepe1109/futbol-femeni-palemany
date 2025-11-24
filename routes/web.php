<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipController;
use App\Http\Controllers\EstadiController;
use App\Http\Controllers\JugadoraController;
use App\Http\Controllers\PartitController;

Route::get('/', function () {
    return redirect()->route('equips.index');
});

// ---------- EQUIPS ----------
Route::get('/equips', [EquipController::class, 'index'])->name('equips.index');
Route::get('/equips/crear', [EquipController::class, 'create'])->name('equips.create');
Route::post('/equips', [EquipController::class, 'store'])->name('equips.store');
Route::get('/equips/{id}', [EquipController::class, 'show'])->name('equips.show');
Route::get('/equips/{id}/editar', [EquipController::class, 'edit'])->name('equips.edit');
Route::put('/equips/{id}', [EquipController::class, 'update'])->name('equips.update');
Route::delete('/equips/{id}', [EquipController::class, 'destroy'])->name('equips.destroy');


// ---------- ESTADIS ----------
Route::get('/estadis', [EstadiController::class, 'index'])->name('estadis.index');
Route::get('/estadis/crear', [EstadiController::class, 'create'])->name('estadis.create');
Route::post('/estadis', [EstadiController::class, 'store'])->name('estadis.store');
Route::get('/estadis/{id}', [EstadiController::class, 'show'])->name('estadis.show');
Route::get('/estadis/{id}/editar', [EstadiController::class, 'edit'])->name('estadis.edit');
Route::put('/estadis/{id}', [EstadiController::class, 'update'])->name('estadis.update');
Route::delete('/estadis/{id}', [EstadiController::class, 'destroy'])->name('estadis.destroy');


// ---------- JUGADORES ----------
Route::get('/jugadores', [JugadoraController::class, 'index'])->name('jugadores.index');
Route::get('/jugadores/crear', [JugadoraController::class, 'create'])->name('jugadores.create');
Route::post('/jugadores', [JugadoraController::class, 'store'])->name('jugadores.store');
Route::get('/jugadores/{id}', [JugadoraController::class, 'show'])->name('jugadores.show');
Route::get('/jugadores/{id}/editar', [JugadoraController::class, 'edit'])->name('jugadores.edit');
Route::put('/jugadores/{id}', [JugadoraController::class, 'update'])->name('jugadores.update');
Route::delete('/jugadores/{id}', [JugadoraController::class, 'destroy'])->name('jugadores.destroy');


// ---------- PARTITS ----------
Route::get('/partits', [PartitController::class, 'index'])->name('partits.index');
Route::get('/partits/crear', [PartitController::class, 'create'])->name('partits.create');
Route::post('/partits', [PartitController::class, 'store'])->name('partits.store');
Route::get('/partits/{id}', [PartitController::class, 'show'])->name('partits.show');
Route::get('/partits/{id}/editar', [PartitController::class, 'edit'])->name('partits.edit');
Route::put('/partits/{id}', [PartitController::class, 'update'])->name('partits.update');
Route::delete('/partits/{id}', [PartitController::class, 'destroy'])->name('partits.destroy');
