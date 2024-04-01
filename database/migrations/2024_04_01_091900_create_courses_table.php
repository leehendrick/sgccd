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
        Schema::create('courses', function (Blueprint $table) {
            $table->id()->index();
            $table->string('nome');
            $table->string('descricao');
            $table->string('duracao');
            $table->double('preco');
            $table->date('data_inicio');
            $table->date('data_termino');
            $table->date('local');
            $table->integer('vagas');
            $table->string('requisitos');
            $table->string('status');
            $table->unsignedBigInteger('categories_id')->index();
            $table->timestamps();

            $table->foreign('categories_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
