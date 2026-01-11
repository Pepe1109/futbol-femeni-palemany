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
            $table->timestamps();
        });

        // 2. ARA que equips existeix, connectem la taula users amb equips
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('team_id')
                  ->references('id')->on('equips')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        // Primer trenquem la relació
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
        });
        // Després esborrem la taula
        Schema::dropIfExists('equips');
    }
};