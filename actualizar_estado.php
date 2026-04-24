<?php
include 'db.php';

// Verificamos que los parámetros lleguen por la URL
if (isset($_GET['id']) && isset($_GET['estado'])) {
    
    $id = intval($_GET['id']); 
    $nuevo_estado = $_GET['estado'];

    // SQL basado exactamente en tus tablas de phpMyAdmin
    $sql = "UPDATE citas SET estado = '$nuevo_estado' WHERE id_cita = $id";

    try {
        if ($conn->query($sql) === TRUE) {
            // Regresar al panel de inmediato
            header("Location: ver_citas.php");
            exit(); 
        } else {
            echo "Error al actualizar: " . $conn->error;
        }
    } catch (mysqli_sql_exception $e) {
        echo "Error de Base de Datos: " . $e->getMessage();
        echo "<br><br><a href='ver_citas.php'>Regresar al panel</a>";
    }
} else {
    header("Location: ver_citas.php");
    exit();
}
?>