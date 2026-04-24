<?php
// Conectamos a la base de datos
include 'db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Kitty Beauty</title>
    <style>
        body { font-family: sans-serif; background-color: #fce4ec; padding: 20px; }
        h1 { color: #d81b60; text-align: center; }
        table { width: 100%; border-collapse: collapse; background: white; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #d81b60; color: white; }
        
        /* Estilos para los botones */
        .btn { padding: 7px 12px; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; margin-right: 5px;}
        .btn-confirmar { background-color: #4CAF50; } /* Verde */
        .btn-cancelar { background-color: #f44336; }  /* Rojo */
        .btn:hover { opacity: 0.8; }
        
        /* Estilos para el texto de los estados */
        .estado-pendiente { color: #ff9800; font-weight: bold; }
        .estado-confirmada { color: #4CAF50; font-weight: bold; }
        .estado-cancelada { color: #f44336; font-weight: bold; }
    </style>
</head>
<body>

    <h1>👑 Panel de Control: Gestión de Citas</h1>
    
    <table>
        <tr>
            <th>Folio</th>
            <th>Cliente</th>
            <th>Teléfono</th>
            <th>Servicio</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php
        // LÓGICA: Usamos INNER JOIN para unir las 3 tablas y traer los nombres reales
        $sql = "SELECT c.id_cita, cl.nombre_completo, cl.telefono, s.nombre_servicio, c.fecha_cita, c.hora_cita, c.estado 
                FROM citas c
                INNER JOIN clientes cl ON c.id_cliente = cl.id_cliente
                INNER JOIN servicios s ON c.id_servicio = s.id_servicio
                ORDER BY c.fecha_cita ASC, c.hora_cita ASC";
        
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            // Ciclo para imprimir cada cita
            while($fila = $resultado->fetch_assoc()) {
                
                // Definir qué color ponerle al texto del estado
                $clase_estado = "estado-" . strtolower($fila['estado']);
                
                echo "<tr>";
                echo "<td>" . $fila['id_cita'] . "</td>";
                echo "<td>" . $fila['nombre_completo'] . "</td>";
                echo "<td>" . $fila['telefono'] . "</td>";
                echo "<td>" . $fila['nombre_servicio'] . "</td>";
                echo "<td>" . $fila['fecha_cita'] . "</td>";
                echo "<td>" . $fila['hora_cita'] . "</td>";
                echo "<td class='$clase_estado'>" . $fila['estado'] . "</td>";
                
                // COLUMNA DE BOTONES DE ACCIÓN
                echo "<td>";
                // Solo mostramos los botones si la cita está "Pendiente"
                if ($fila['estado'] == 'Pendiente') {
                    // Botón Confirmar
                    echo "<form action='actualizar_estado.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>
                            <input type='hidden' name='nuevo_estado' value='Confirmada'>
                            <button type='submit' class='btn btn-confirmar'>✔ Confirmar</button>
                          </form> ";
                    // Botón Cancelar
                    echo "<form action='actualizar_estado.php' method='POST' style='display:inline;'>
                            <input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>
                            <input type='hidden' name='nuevo_estado' value='Cancelada'>
                            <button type='submit' class='btn btn-cancelar'>✖ Cancelar</button>
                          </form>";
                } else {
                    echo "<em>Procesada</em>"; // Si ya se confirmó o canceló, ya no hay botones
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No hay citas registradas en el sistema.</td></tr>";
        }
        ?>
    </table>
    
    <br><br>
    <a href="index.php" style="color: #d81b60; font-weight: bold; text-decoration: none;">⬅ Volver a la vista del Cliente (Agendar nueva cita)</a>

</body>
</html>