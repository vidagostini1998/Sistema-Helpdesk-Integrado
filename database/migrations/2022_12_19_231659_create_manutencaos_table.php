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
        Schema::create('manutencaos', function (Blueprint $table) {
            $table->id();
            $table->date('data_manutencao')->nullable();
            $table->date('data_realizada')->nullable();
            $table->string('solicitante');
            $table->boolean('tipo_manutencao');
            $table->longText('motivo');
            $table->longText('problema');
            $table->longText('solucao');
            $table->longText('obs_manutencao');
            $table->boolean('status_manutencao');
            $table->unsignedBigInteger('id_patrimonio')->nullable();
            $table->foreign('id_patrimonio')->references('id')->on('patrimonios')->onDelete('set null')->onUpdate('cascade');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('manutencaos');
    }
};
