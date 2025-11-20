<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('estadis', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ciutat')->nullable();
            $table->unsignedInteger('capacitat')->default(0);
            $table->string('equip_principal')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estadis');
    }
};
