<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuntesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulo_apuntes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->timestamps();
        });

        Schema::create('apuntes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('texto');
            $table->string('imagen');
            $table->foreignId('user_id')->references('id')->on('users')->comment('El usuario que crea el apunte');
            $table->foreignId('modulo_id')->index('id')->on('modulo_apuntes')->coment('El módulo del apunte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulo_apuntes');
        Schema::dropIfExists('apuntes');
    }
}
