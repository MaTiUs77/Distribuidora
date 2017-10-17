<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobranzasTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobranzas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->double('monto',10,2);
            $table->string('comprobante');
            $table->string('nota');

            $table->integer('venta_id')->unsigned();
            $table->integer('cuentas_id')->unsigned();

            $table->foreign('venta_id')->references('id')->on('ventas');
            $table->foreign('cuentas_id')->references('id')->on('cuentas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cobranzas');
    }
}
