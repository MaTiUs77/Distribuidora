<?php

namespace App\Http\Controllers\Venta_Detalle;

use App\Http\Controllers\Cuentas\Model\CuentasModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Inventario\Inventario;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Ventas\Model\VentasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Venta_Detalle extends Controller
{
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),Ventas_DetallesModel::rules());
        if ($validator->fails()) {
            return redirect(route('venta_detalle.show',$request->get('venta_id')))->withErrors($validator);
        }
        $inventario = new Inventario();
        $newventa = Ventas_DetallesModel::where('producto_id', $request->get('producto_id'))
            ->where('venta_id', $request->get('venta_id'))
            ->first();

        $controlStock = $inventario->descontarProducto($request->producto_id,$request->cantidad);
        if($controlStock != true)
        {
            if($newventa != null)
            {
                $newventa->cantidad += $request->get('cantidad');
                $newventa->save();
            }
            else
            {
                $newventa = new Ventas_DetallesModel();
                $newventa->venta_id = $request->get('venta_id');
                $newventa->producto_id = $request->get('producto_id');
                $newventa->cantidad = $request->get('cantidad');
                $newventa->save();
            }
            return redirect(route('venta_detalle.show',$newventa->venta_id));
        }
        else
        {
            return redirect(route('venta_detalle.show',$request->venta_id))->withErrors('Solo dispones de '.$controlStock->producto->stock.' unidades' );
        }

        // Generar nuevos datos de la factuacion
//        $api  = new ApiVentaDetalle();
//        $response = $api->resumen($newventa->venta_id);

        // Publica en el canal de venta redis
//        Redis::set('venta', json_encode($response));
//        Redis::publish('venta', json_encode($response));

        return "OK";


        //return redirect(route('venta_detalle.show',$newventa->venta_id));


//        SE LLAMA A INVENTARIO PARA CONSULTAR STOCK DE PRODUCTO
//        $inventario = new Inventario();
//        $inv = $inventario->descontarProducto($request->get('producto_id'),$request->get('cantidad'));


    }

    public function show($id)
    {
        $venta = VentasModel::findOrFail($id);
        $detalles = Ventas_DetallesModel::where('venta_id',$id)->get();

        $resumen = new ResumenDetalle($venta, $detalles);
        
        $cuentas = CuentasModel::where('tipo','EFECTIVO')
            ->orWhere('tipo','A COBRAR')
            ->orWhere('tipo','BANCO')
            ->get();

        $datos = compact('venta','resumen','cuentas');
        return view('venta_detalle.show',$datos);
    }

    public function edit($id)
    {
        /*$venta = VentasModel::findOrFail($id);
        $venta_detalle = Ventas_DetallesModel::where('venta_id',$id)->get();
        $datos = compact('venta','venta_detalle');
        return view('ventas.create',$datos);*/
    }

    public function update(Request $request, $id)
    {
        $inventario = new Inventario();
        $venta = VentasModel::findOrFail($id);
        $venta_d = Ventas_DetallesModel::findOrFail($request->get('venta_detalle_id'));
        $producto = $inventario->actualizarCantidadProducto($venta_d,$request->get('cantidad'));
        if($producto == true)
        {
            return redirect(route('venta_detalle.show',$id))->withErrors('Solo dispones de '.$producto->stock);
        }

        $venta_d->cantidad = $request->get('cantidad');
        $venta_d->save();

        //$venta_detalle = Ventas_DetallesModel::where('venta_id',$id)->get();

        return redirect(route('venta_detalle.show',$id));

        //$datos = compact('venta','venta_detalle');
        //return view('ventas.create',$datos);
    }

    public function destroy($id)
    {
         $devolverProducto = new Inventario();
        $venta_detalle = Ventas_DetallesModel::findOrFail($id);
        $producto = $devolverProducto->devolverUnProducto($venta_detalle);

        $venta_detalle->delete();
        return redirect(route('venta_detalle.show',$venta_detalle->venta_id));
    }
}
