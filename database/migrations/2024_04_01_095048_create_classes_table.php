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
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('nome');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->string('local');
            $table->string('status');
            $table->string('descricao');
            $table->unsignedBigInteger('curso_id')->index();
            $table->unsignedBigInteger('instrutor_id')->index();
            $table->unsignedBigInteger('horario_id')->index();
            $table->timestamps();

            $table->foreign('curso_id')
                ->references('id')
                ->on('courses');

            $table->foreign('instrutor_id')
                ->references('id')
                ->on('instrutores');

            $table->foreign('horario_id')
                ->references('id')
                ->on('horarios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
