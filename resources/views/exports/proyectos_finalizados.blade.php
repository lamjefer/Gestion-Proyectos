<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre del Proyecto</th>
            <th>Cliente</th>
            <th>Fecha de Inicio</th>
            <th>Fecha Entrega Real</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proyectos as $proyecto)
        <tr>
            <td>{{ $proyecto->id }}</td>
            <td>{{ $proyecto->nombre_proyecto }}</td>
            <td>{{ $proyecto->cliente }}</td>
            <td>{{ $proyecto->fecha_inicio }}</td>
            <td>{{ $proyecto->fecha_entrega_real }}</td>
            <td>{{ $proyecto->estado }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
