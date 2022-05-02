<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('id_pac');
            $table->string('nombrePac', length: 50);
            $table->bigInteger('CI');
            $table->string('fecha_nac');
            $table->string('celular', length: 10);
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_user')->on('users')->references('id')
            ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
};
