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
        Schema::create('solicitacoes_cursos', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->date('data_solicitacao');
            $table->string('observacao');
            $table->date('data_aprov_reje');
            $table->string('motivo_rejeicao');
            $table->unsignedBigInteger('curso_id')->index();
            $table->unsignedBigInteger('status_id')->index();
            $table->unsignedBigInteger('tipo_solicitacao')->index();
            $table->timestamps();

            $table->foreign('curso_id')
                ->references('id')
                ->on('courses');

            $table->foreign('status_id')
                ->references('id')
                ->on('solicitacoes_status');

            $table->foreign('tipo_solicitacao')
                ->references('id')
                ->on('solicitantes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes_cursos');
    }
};
