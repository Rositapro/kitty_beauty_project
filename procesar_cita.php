<?php
// 1. Incluimos la conexión
include 'db.php';

// 2. Recibimos los datos que mandó el formulario (index.php)
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$id_servicio = $_POST['id_servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// --- LÓGICA DE PROGRAMACIÓN ---

// PASO A: Verificar disponibilidad (Sentencia IF/ELSE y Base de Datos)
// Consultamos si ya existe una cita en esa misma fecha y hora
$sql_check = "SELECT * FROM citas WHERE fecha_cita = '$fecha' AND hora_cita = '$hora'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // CASO 1: El horario está ocupado
    echo "<h1>❌ Lo sentimos, ese horario ya está reservado.</h1>";
    echo "<p>Por favor intenta con otra hora.</p>";
    echo "<a href='index.php'>Volver al formulario</a>";

} else {
    // CASO 2: El horario está libre, procedemos a guardar
    
    // Primero insertamos al cliente (o buscamos si ya existe)
    // Para esta práctica, insertaremos uno nuevo siempre para simplificar
    $sql_cliente = "INSERT INTO clientes (nombre_completo, telefono) VALUES ('$nombre', '$telefono')";
    
    if ($conn->query($sql_cliente) === TRUE) {
        // Obtenemos el ID que la base de datos le acaba de asignar a este cliente nuevo
        $id_cliente_nuevo = $conn->insert_id;

        // Ahora sí, guardamos la CITA vinculando Cliente + Servicio
        $sql_cita = "INSERT INTO citas (id_cliente, id_servicio, fecha_cita, hora_cita) 
                     VALUES ('$id_cliente_nuevo', '$id_servicio', '$fecha', '$hora')";

        if ($conn->query($sql_cita) === TRUE) {
            echo "<h1>✅ ¡Cita Agendada con Éxito!</h1>";
            echo "<p>Gracias <strong>$nombre</strong>, tu cita ha quedado registrada.</p>";
            echo "<a href='index.php'>Agendar otra cita</a>";
        } else {
            echo "Error al guardar la cita: " . $conn->error;
        }

    } else {
        echo "Error al registrar tus datos: " . $conn->error;
    }
}

// Cerramos la conexión
$conn->close();
?>