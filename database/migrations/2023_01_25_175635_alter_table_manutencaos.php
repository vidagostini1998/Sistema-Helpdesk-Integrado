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
            $table->dropForeign('manutencaos_id_local_foreign');
            $table->dropColumn('id_local');
            $table->dropForeign('manutencaos_id_filial_foreign');
            $table->dropColumn('id_filial');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
