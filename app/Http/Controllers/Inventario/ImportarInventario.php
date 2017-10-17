<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;


class ImportarInventario extends Controller
{
    public function index()
    {
        return view('inventario.index');
    }

    public function download($type)
    {
        $data = ProductosModel::get()->toArray();
        return Excel::create('inventario', function($excel) use ($data) {
            $excel->sheet('Hoja', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);
    }

    public function import()
    {
        if(Input::hasFile('import_file'))
        {
            $path = Input::file('import_file')->getRealPath();
            $this->importExcel($path);
        }

        // Retorno a la pagina anterior
        return back();
    }

    public function importExcel($filePath)
    {
        $data = Excel::load($filePath)->get();


        $data->each(function($fila){
            $fila['precio_venta'] = $this->calcularPorcentaje($fila->precio_proveedor,$fila->aplicar_porcentaje);
        });

        // Existen filas?
        if(!empty($data) && $data->count())
        {
            // Se guardan los datos en el modelo
            DB::table('productos')->insert($data->toArray());
            dump('Archivo Importado con exito');
            return true;
        } else {
            return false;
        }
    }

    public function calcularPorcentaje($precio,$porcentaje)
    {
        $precio_venta =   ($precio * $porcentaje/ 100) + $precio;
        return $precio_venta;
    }


}
