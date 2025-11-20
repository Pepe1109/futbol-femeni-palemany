<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('partits', function (Blueprint $table) {
            $table->id();

            // Equip local i visitant
            $table->foreignId('local_id')->constrained('equips')->cascadeOnDelete();
            $table->foreignId('visitant_id')->constrained('equips')->cascadeOnDelete();

            // Estadi opcional
            $table->foreignId('estadi_id')->nullable()->constrained('estadis')->nullOnDelete();

            // Data i jornada
            $table->date('data');
            $table->unsignedSmallInteger('jornada')->nullable();

            // Resultat del partit en format "2-1"
            $table->string('resultat')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partits');
    }
};
