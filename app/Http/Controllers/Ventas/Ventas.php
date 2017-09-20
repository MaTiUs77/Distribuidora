<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Perfil\Model\PerfilModel;
use App\Http\Controllers\Usuarios\Usuarios;
use App\Http\Controllers\Venta_Detalle\Model\Ventas_DetallesModel;
use App\Http\Controllers\Venta_Detalle\Venta_Detalle;
use App\Http\Controllers\Ventas\Model\VentasModel;
use App\User;
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
        $clientes = User::role('clientes')->get();
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
                $nuevaVenta->fecha_entrega = '2017/09/18';
                $nuevaVenta->estado = 'Pendiente de entrega';
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
        $vet = Ventas_DetallesModel::where('venta_id',$id)->delete();
        $ventas = VentasModel::findOrFail($id);
        $ventas->delete();
        return redirect()->route('ventas.pendientes')->with('message', 'venta eliminada con exito!');
    }
}
