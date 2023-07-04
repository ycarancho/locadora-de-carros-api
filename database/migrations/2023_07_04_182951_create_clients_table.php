<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 250);
            $table->string('email', 50);
            $table->string('telefone', 50);
            $table->date('data_nascimento');
            $table->string('rua', 250);
            $table->string('bairro', 250);
            $table->integer('numero');
            $table->string('cpf', 50);
            $table->string('rg', 50);
            $table->string('cnh', 50);
            $table->string('validade_cnh', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
