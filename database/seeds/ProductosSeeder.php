<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\Productos\Model\ProductosModel;

class ProductosSeeder extends Seeder
{
    public function run()
    {
        $file = \Illuminate\Support\Facades\Storage::disk('local')->path('inventario.xls');

        $import = new \App\Http\Controllers\Inventario\ImportarInventario();
        $import->importExcel($file);
    }
}
