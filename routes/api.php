<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// --- IMPORTAMOS LOS CONTROLADORES DE LA API ---
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EquipController;
use App\Http\Controllers\Api\EstadiController;
use App\Http\Controllers\Api\PartitController;
use App\Http\Controllers\Api\JugadoraController;

// =================================================================
// 🔓 RUTAS PÚBLICAS (No necesitan Token)
// =================================================================

// Registro y Login para obtener el Token
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// =================================================================
// 🔒 RUTAS PROTEGIDAS (Necesitan Token 'Bearer')
// =================================================================

Route::middleware('auth:sanctum')->group(function () {
    
    // --- AUTENTICACIÓN ---
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('profile', [AuthController::class, 'profile']); // El endpoint extra que pedía el ejercicio

    // --- RECURSOS (CRUDs COMPLETOS) ---
    // apiResource crea automáticamente las rutas: index, store, show, update, destroy
    
    Route::apiResource('equips', EquipController::class);
    Route::apiResource('estadis', EstadiController::class);
    Route::apiResource('partits', PartitController::class);
    Route::apiResource('jugadores', JugadoraController::class);

});