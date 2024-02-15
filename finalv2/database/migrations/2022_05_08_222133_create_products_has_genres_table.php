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
        Schema::create('products_has_genres', function (Blueprint $table) {
            $table->foreignId('id_product')->constrained('products','id_product');
            $table->unsignedSmallInteger('id_genre');
            $table->foreign('id_genre')->references('id_genre')->on('genres');
            // DEFINO EL PK
            $table->primary(['id_product','id_genre']);
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
        Schema::dropIfExists('products_has_genres');
    }
};
