<?php
include 'db.php';

// Consulta exacta uniendo clientes, citas y servicios
$sql = "SELECT ci.id_cita, cl.nombre_completo, cl.telefono, s.nombre_servicio, ci.fecha_cita, ci.hora_cita, ci.estado 
        FROM citas ci
        INNER JOIN clientes cl ON ci.id_cliente = cl.id_cliente
        INNER JOIN servicios s ON ci.id_servicio = s.id_servicio
        ORDER BY ci.fecha_cita DESC";

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Citas | Kitty Beauty</title>
    <link rel="stylesheet" href="css/inicio.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* RESET DE CURSOR: Solo para esta página */
        * { cursor: default !important; }
        a, button, .btn-accion, th { cursor: pointer !important; }

        body { 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            padding: 40px 20px; 
        }
        .tabla-contenedor { 
            width: 100%; 
            max-width: 1100px; 
            padding: 30px; 
            z-index: 100; 
        }
        .titulo-citas { 
            font-family: 'Great Vibes', cursive; 
            color: #ad1457; 
            font-size: 3.5rem; 
            text-align: center; 
            margin-bottom: 20px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 15px; 
            overflow: hidden; 
        }
        th { 
            background-color: rgba(240, 98, 146, 0.7); 
            color: white; 
            padding: 15px; 
            text-transform: uppercase; 
            font-size: 0.8rem; 
        }
        td { 
            padding: 12px; 
            border-bottom: 1px solid rgba(248, 187, 208, 0.3); 
            color: #37474f; 
            text-align: center; 
            background: rgba(255, 255, 255, 0.1); 
            font-size: 0.9rem; 
        }
        tr:hover td { background: rgba(255, 255, 255, 0.4); }
        
        .status { 
            background: #fce4ec; 
            color: #ad1457; 
            padding: 4px 10px; 
            border-radius: 15px; 
            font-size: 0.75rem; 
            font-weight: bold; 
        }

        /* Botones de acción */
        .btn-accion { 
            padding: 8px 15px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-size: 1rem; 
            font-weight: bold; 
            margin: 0 5px; 
            display: inline-block; 
            transition: 0.3s; 
        }
        .btn-aceptar { background-color: #4caf50; color: white; border: none; }
        .btn-aceptar:hover { background-color: #388e3c; transform: scale(1.1); }
        .btn-rechazar { background-color: #f44336; color: white; border: none; }
        .btn-rechazar:hover { background-color: #d32f2f; transform: scale(1.1); }
        
        .btn-regresar { 
            text-decoration: none; 
            color: #ad1457; 
            font-weight: bold; 
            display: inline-block; 
            margin-bottom: 15px; 
        }
    </style>
</head>
<body>
    <div class="sakura-container" id="sakura-container"></div>

    <div class="glass-card tabla-contenedor">
        <a href="index.html" class="btn-regresar">← Volver al Menú</a>
        <h2 class="titulo-citas">Panel de Citas</h2>
        <table>
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Teléfono</th>
                    <th>Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['nombre_completo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['telefono']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre_servicio']) . "</td>";
                        echo "<td>" . date("d/m/Y", strtotime($fila['fecha_cita'])) . "</td>";
                        echo "<td>" . date("g:i a", strtotime($fila['hora_cita'])) . "</td>";
                        echo "<td><span class='status'>" . htmlspecialchars($fila['estado']) . "</span></td>";
                        echo "<td>
                                <a href='actualizar_estado.php?id=" . $fila['id_cita'] . "&estado=Aceptada' class='btn-accion btn-aceptar' title='Aceptar'>✓</a>
                                <a href='actualizar_estado.php?id=" . $fila['id_cita'] . "&estado=Rechazada' class='btn-accion btn-rechazar' title='Rechazar'>✗</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay citas registradas. 🌸</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="js/sakura.js"></script>
</body>
</html>