<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();
            // Definimos local_id y visitant_id explícitamente
            $table->foreignId('local_id')->constrained('equips')->onDelete('cascade');
            $table->foreignId('visitant_id')->constrained('equips')->onDelete('cascade');
            $table->date('data');
            $table->string('resultat')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};