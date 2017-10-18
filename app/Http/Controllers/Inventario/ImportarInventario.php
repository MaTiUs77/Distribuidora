<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\Http\Controllers\Productos\Model\ProductosModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

use Spatie\Permission\Models\Role;
use App\User;



class ImportarInventario extends Controller
{
    public function download($type)
    {
        $data = ProductosModel::with([
            'Almacen',
            'Marca',
            'Categoria',
            'Proveedor',
        ])->get()->toArray();

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

    public function downloadPdf($data,$forceDownload=false)
    {
        $output = compact('data');
        $pdf = PDF::loadView('inventario.pdf', $output)
            ->setPaper('A4', 'landscape');

        if($forceDownload)
        {
            return $pdf->download('inventario.pdf');
        } else
        {
            return $pdf->stream('inventario.pdf');
        }
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

            $almacen = AlmacenesModel::firstOrCreate(['nombre' => $fila->id_almacen]);
            $marca = MarcasModel::firstOrCreate(['nombre' => $fila->id_marca]);
            $categoria = CategoriasModel::firstOrCreate(['nombre' => $fila->id_categoria]);

            $fila['id_almacen'] = $almacen->id;
            $fila['id_marca'] = $marca->id;
            $fila['id_categoria'] = $categoria->id;

            // Existe proveedor?
            $proveedor = User::where('email',$fila->id_proveedor.'@default')->first();

            if($proveedor==null)
            {
                // Alta de proveedor
                $proveedor = User::create([
                    'name' => $fila->id_proveedor,
                    'email' => $fila->id_proveedor.'@default',
                    'password' => bcrypt('interna'),
                ]);
            }

            $proveedor->syncRoles('proveedor');

            $fila['id_proveedor'] = $proveedor->id;

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
