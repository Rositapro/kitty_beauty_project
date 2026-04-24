<?php
// 1. Incluimos la conexión a la BD
include 'db.php';

// 2. Recibimos los datos ocultos que mandó el botón
$id_cita = $_POST['id_cita'];
$nuevo_estado = $_POST['nuevo_estado'];

// 3. SENTENCIA SQL (UPDATE): Cambiamos el estado de esa cita en específico
$sql = "UPDATE citas SET estado = '$nuevo_estado' WHERE id_cita = $id_cita";

if ($conn->query($sql) === TRUE) {
    // Si la actualización sale bien, redireccionamos automáticamente de vuelta al panel
    header("Location: ver_citas.php");
    exit();
} else {
    // Si hay error, lo mostramos
    echo "Error al actualizar el estado: " . $conn->error;
}

$conn->close();
?>