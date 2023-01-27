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
        Schema::create('patrimonios', function (Blueprint $table) {
            $table->id();
            $table->string('patrimonio')->unique();
            $table->string('nome');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('n_serie')->nullable();
            $table->string('fornecedor')->nullable();
            $table->string('ref')->nullable();
            $table->longText('obs_patrimonio')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_local')->nullable();
            $table->foreign('id_local')->references('id')->on('locals')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categoria_patrimonios')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('id_filial')->nullable();
            $table->foreign('id_filial')->references('id')->on('filials')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('patrimonios');
    }
};
