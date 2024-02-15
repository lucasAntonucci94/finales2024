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
        // al crear el migration con el nombre de add_nombre me pondra la siguiente instruccion al crear mi migrations Schema::table
        // el cual me permite en vez de crear una nueva tabla, modificar una tabla existente
        Schema::table('products', function (Blueprint $table) {

            $table->unsignedSmallInteger('id_provider');
            $table->foreign('id_provider')->references('id_provider')->on('providers');
            // // OPCION 2: crea el foregin key como un BigInteger
            // $table->foreingId('id_provider')->constrained('providers','id_provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('id_provider');
        });
    }
};
