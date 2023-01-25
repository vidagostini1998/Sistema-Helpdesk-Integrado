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
        Schema::table('manutencaos',function(Blueprint $table){
            $table->unsignedBigInteger('id_prestador')->nullable();
            $table->foreign('id_prestador')->references('id')->on('prestadores')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manutencaos',function(Blueprint $table){
           $table->dropForeign('manutencaos_id_prestador_foreign');
           $table->dropColumn('id_prestador');
        });
    }
};
