<table class="table table-striped">
    <tbody>
    <tr>
        <th>Nombre</th>
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

    @foreach($data as $item)

        <?php
            $item = (object) $item;
        ?>
        <tr>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->barcode }}</td>
            <td>{{ $item->precio_proveedor }}</td>
            <td>{{ $item->precio_venta }}</td>
            <td>{{ $item->aplicar_porcentaje }}</td>
            <td>{{ $item->estado }}</td>
            <td>{{ $item->stock }}</td>
            <td>{{ $item->id_almacen }}</td>
            <td>{{ $item->id_proveedor }}</td>
            <td>{{ $item->id_marca }}</td>
            <td>{{ $item->id_categoria }}</td>
        </tr>
    @endforeach

    </tbody>
</table>