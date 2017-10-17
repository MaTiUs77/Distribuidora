<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\Productos\Model\ProductosModel;

class ProductosSeeder extends Seeder
{
    public function run()
    {
/*        ProductosModel::create([
            'nombre' => 'Leche',
            'barcode' => '0001',
            'precio_proveedor' => '100',
            'precio_venta' => '150',
            'aplicar_porcentaje' => '50',
            'stock' => '200',
            'stock_minimo' => '300',
            'id_almacen' => 1,
            'id_proveedor' => 1,
            'id_marca' => 1,
            'id_categoria' => 1,
          ]);

        ProductosModel::create([
            'nombre' => 'Fideos',
            'barcode' => '0002',
            'precio_proveedor' => '10',
            'precio_venta' => '15',
            'aplicar_porcentaje' => '50',
            'stock' => '120',
            'stock_minimo' => '100',
            'id_almacen' => 1,
            'id_proveedor' => 1,
            'id_marca' => 1,
            'id_categoria' => 1,
          ]);*/

        $file = \Illuminate\Support\Facades\Storage::disk('local')->path('inventario.xls');

        $import = new \App\Http\Controllers\Inventario\ImportarInventario();
        $import->importExcel($file);
    }
}
