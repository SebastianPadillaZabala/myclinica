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
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->id();
            $table->string('usuario');
            $table->string('operacion');
            $table->dateTime('hora');
            $table->string('nombre_pac');
            $table->unsignedBigInteger('id_paciente');
            
            $table->timestamps();

            $table->foreign('id_paciente')->on('pacientes')->references('id_pac')
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
        Schema::dropIfExists('bitacoras');
    }
};
