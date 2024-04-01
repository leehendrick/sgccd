<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('nome');
            $table->string('email');
            $table->string('bi');
            $table->date('data_nascimento');
            $table->string('instituicao');
            $table->string('area_formacao');
            $table->date('data_inscricao');
            $table->char('genero');
            $table->integer('telefone');
            $table->unsignedBigInteger('curso_id')->index();
            $table->unsignedBigInteger('nivel_academico_id')->index();
            $table->timestamps();

            $table->foreign('curso_id')
                ->references('id')
                ->on('courses');

            $table->foreign('nivel_academico_id')
                ->references('id')
                ->on('academic_levels');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
