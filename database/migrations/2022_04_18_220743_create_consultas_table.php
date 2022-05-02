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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id('id_con');
            $table->string('fecha');
            $table->string('hora');
            $table->string('motivo');
            $table->string('estado');
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_doctor');

            $table->foreign('id_paciente')->on('pacientes')->references('id_pac')
            ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_doctor')->on('doctores')->references('id_doc')
            ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('consultas');
    }
};
