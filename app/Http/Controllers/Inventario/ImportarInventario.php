<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use PDF;


class ImportarInventario extends Controller
{
    public function download($type)
    {
        $data = ProductosModel::get()->toArray();

        switch ($type)
        {
            case 'pdf':
                return $this->downloadPdf($data);
            break;
            default:

                return Excel::create('inventario', function ($excel) use ($data) {
                    $excel->sheet('Hoja', function ($sheet) use ($data) {
                        $sheet->fromArray($data);
                    });
                })->download($type);
            break;
        }
    }

    public function downloadPdf($data)
    {
        $output = compact('data');
        $pdf = PDF::loadView('inventario.pdf', $output);
        return $pdf->download('inventario.pdf');
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
