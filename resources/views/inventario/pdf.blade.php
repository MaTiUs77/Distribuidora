<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<style>
    html {
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    table thead tr {
        background-color: #0a0a0a;
        color: #ffffff;
    }

    tbody td{
        padding: 2px;
    }

    tbody tr:nth-child(odd){
        background-color: #F4F4F4;
        color: #000000;
    }

</style>
<table cellpadding="0" cellspacing="0">
    <thead>
    <tr>
        <th>Producto</th>
        <th>Codigo</th>
        <th>Barcode</th>
        <th>Precio Proveedor</th>
        <th>Precio Venta</th>
        <th>Porcentaje</th>
        <th>Estado</th>
        <th>Stock</th>
        <th>Almacen</th>
        <th>Proveedor</th>
        <th>Marca</th>
        <th>Categoria</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)

        <?php
            $item = (object) $item;
        ?>
        <tr>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->codigo_interno }}</td>
            <td>{{ $item->barcode }}</td>
            <td>{{ $item->precio_proveedor }}</td>
            <td>{{ $item->precio_venta }}</td>
            <td>{{ $item->aplicar_porcentaje }}</td>
            <td>{{ $item->estado }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->almacen['nombre'] }}</td>
            <td>{{ $item->proveedor['name'] }}</td>
            <td>{{ $item->marca['nombre'] }}</td>
            <td>{{ $item->categoria['nombre'] }}</td>
        </tr>
    @endforeach

    </tbody>
</table>