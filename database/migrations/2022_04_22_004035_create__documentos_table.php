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
        Schema::create('_documentos', function (Blueprint $table) {
            $table->id('id_docum');
            $table->string('descripcion_doc');
            $table->string('url_diagnostico');
            $table->unsignedBigInteger('id_consulta');

            $table->foreign('id_consulta')->on('consultas')->references('id_con')
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
        Schema::dropIfExists('_documentos');
    }
};
