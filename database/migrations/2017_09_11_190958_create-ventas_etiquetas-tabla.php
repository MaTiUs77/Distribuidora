<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasEtiquetasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas_etiquetas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('ventas_id');
            $table->integer('etiquetas_id');

            $table->foreign('ventas_id')->references('id')->on('ventas');
            $table->foreign('etiquetas_id')->references('id')->on('etiquetas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ventas_etiquetas');
    }
}
