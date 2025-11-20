<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equip_id')->constrained('equips')->cascadeOnDelete();
            $table->string('nom');
            $table->string('cognoms');           // <-- AFEGIT
            $table->date('data_naixement')->nullable();
            $table->unsignedSmallInteger('dorsal')->nullable();
            $table->string('posicio')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
};
