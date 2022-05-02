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
        Schema::create('examenes', function (Blueprint $table) {
            $table->id('id_exa');
            $table->string('nombre_examen');
            $table->string('url_examen');
            $table->unsignedBigInteger('id_documento');
            $table->unsignedBigInteger('id_laboratorio');
            $table->unsignedBigInteger('id_paciente');
            

            $table->foreign('id_documento')->on('_documentos')->references('id_docum')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_paciente')->on('pacientes')->references('id_pac')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('id_laboratorio')->on('laboratorios')->references('id_lab')
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
        Schema::dropIfExists('examenes');
    }
};
