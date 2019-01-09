<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Empresarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',20)->unique();
            $table->string('razonsocial');
            $table->string('nombre');
            $table->string('pais');
            $table->char('tipo_moneda',5);
            $table->string('estado');
            $table->string('ciudad');
            $table->char('telefono',25);
            $table->string('correo');
            $table->enum('activo',['si','no']);
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
        Schema::dropIfExists('empresarios');
    }
}
