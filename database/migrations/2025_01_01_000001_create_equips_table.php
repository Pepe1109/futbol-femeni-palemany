<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // 1. Creem la taula EQUIPS
        Schema::create('equips', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('ciutat')->nullable();
            $table->string('lliga')->nullable();
            $table->integer('titols')->default(0);
            $table->string('escut')->nullable();
            
            // --- ESTA LÍNEA FALTABA Y ERA EL ERROR AL GUARDAR ---
            $table->foreignId('estadi_id')->nullable(); 
            // ----------------------------------------------------

            $table->timestamps();
        });

        // 2. Relació amb users
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('team_id')
                  ->references('id')->on('equips')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
        });
        Schema::dropIfExists('equips');
    }
};