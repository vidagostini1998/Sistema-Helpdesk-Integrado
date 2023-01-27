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
        Schema::create('situacao_patrimonios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_patrimonio')->nullable();
            $table->foreign('id_patrimonio')->references('id')->on('patrimonios')->onDelete('set null')->onUpdate('cascade');
            $table->string('motivo_situacao');
            $table->date('data_situacao');
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
        Schema::dropIfExists('situacao_patrimonios');
    }
};
