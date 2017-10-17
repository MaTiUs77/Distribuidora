<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->enum('estado', ['COBRADO', 'A COBRAR','VENCIDO']);
            $table->integer('user_id')->unsigned();
            $table->integer('cliente_id')->unsigned();

            $table->integer('cantidad')->nullable();
            $table->string('origen');

            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_vencimiento');

            $table->double('total_venta',10,2);
            $table->double('subtotal_sin_descuento',10,2);
            $table->double('subtotal_con_descuento',10,2);
            $table->double('a_cobrar',10,2);
            $table->double('cobrado',10,2);

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cliente_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ventas');
    }
}
