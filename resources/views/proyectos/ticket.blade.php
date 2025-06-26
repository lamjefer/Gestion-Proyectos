<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket del Proyecto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #000;
            margin: 40px;
        }

        .contenedor {
            border: 1px dashed #000;
            padding: 30px;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .dato {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .dato strong {
            display: inline-block;
            width: 160px;
        }

        .nota {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2>Gestión de Proyectos</h2>

        <p class="dato"><strong>Ticket de Proyecto</strong></p>
        <p class="dato"><strong>ID del Proyecto:</strong> {{ $proyecto->id }}</p>
        <p class="dato"><strong>Nombre del Proyecto:</strong> {{ $proyecto->nombre_proyecto }}</p>
        <p class="dato"><strong>Cliente:</strong> {{ $proyecto->cliente }}</p>
        <p class="meta"><strong>Responsable:</strong> {{ Auth::user()->name }}</p>

        <p class="fecha"><strong>Fecha de Emisión:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

        <p class="nota">Su proyecto ha sido subido al sistema correctamente y se encuentra en curso</p>
    </div>
</body>
</html>

