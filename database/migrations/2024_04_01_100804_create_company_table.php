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
        Schema::create('companies', function (Blueprint $table) {
            $table->id()->index();
            $table->string('nome');
            $table->integer('contato');
            $table->string('representante');
            $table->unsignedBigInteger('address_id')->index();
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('adresses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
