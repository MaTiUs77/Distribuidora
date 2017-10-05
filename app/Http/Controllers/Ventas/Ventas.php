<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\Http\Controllers\Productos\Inventario;
use App\Http\Controllers\Usuarios\Usuarios;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\Venta_Detalle;
use App\Http\Controllers\Ventas\Model\VentasModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Ventas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = User::role('cliente')->get();
        $datos = compact('clientes');
        return view('ventas.index',$datos);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ventas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->get('cliente_id') == null)
        {
            dd("paso por aca");
            return redirect()->route('ventas.index')->with('message', 'Debe seleccionar un cliente!');;
        }
        else
            {
                $nuevaVenta = new VentasModel();
                $nuevaVenta->origen = 'FACTURACION';
                $nuevaVenta->fecha_entrega = Carbon::now();
                $nuevaVenta->estado = 'PENDIENTE';
                $nuevaVenta->user_id = Auth::id();
                $nuevaVenta->cliente_id = $request->get('cliente_id');
                $nuevaVenta->save();

                return redirect(route('venta_detalle.show',$nuevaVenta->id));
            }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venta = VentasModel::findOrFail($id);
        $datos = compact('venta');
        return view('ventas.edit',$datos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ventas = VentasModel::findOrFail($id);
        $ventas->cliente_id = $request->get('cliente_id');
        $ventas->save();
        return redirect()->route('pendientes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Se obtiene todo el detalle de la facturacion
        $detalle = Ventas_DetallesModel::where('venta_id',$id)->get();

        if(count($detalle))
        {
            // Se devuelven todos los productos
            $inventario = new Inventario();
            $inventario->devolverProductosMultiples($detalle);
        }

        // Una vez devuelto el stock se eliminan los detalles
        Ventas_DetallesModel::where('venta_id',$id)->delete();

        // Se elimina la factura (que no fue finalizada)
        $ventas = VentasModel::findOrFail($id);
        $ventas->delete();

        return redirect()->route('pendientes.index')->with('message', 'venta eliminada con exito!');
    }
}
