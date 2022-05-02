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
        Schema::create('medesp', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_especialidad');
            $table->unsignedBigInteger('id_doctor');
            $table->timestamps();

            $table->foreign('id_especialidad')->on('especialidades')->references('id_esp')
            ->onDelete('cascade');
            $table->foreign('id_doctor')->on('doctores')->references('id_doc')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medesp');
    }
};
