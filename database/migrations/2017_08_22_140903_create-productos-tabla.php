<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('nombre')->index();
            $table->string('barcode')->unique();
            $table->text('descripcion')->nullable();
            $table->integer('precio_proveedor')->unsigned();
            $table->integer('precio_venta')->unsigned();
            $table->float('aplicar_porcentaje');
            $table->enum('estado',['activo','inactivo']);
            $table->smallInteger('stock');
            $table->smallInteger('stock_minimo')->nullable();
            $table->integer('id_almacen')->unsigned();
            $table->integer('id_proveedor')->unsigned();
            $table->integer('id_marca')->unsigned();
            $table->integer('id_categoria')->unsigned();
            $table->string('imagen')->nullable();
            $table->timestamps();

            $table->foreign('id_almacen')->references('id')->on('almacenes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_marca')->references('id')->on('marcas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_categoria')->references('id')->on('categorias')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
