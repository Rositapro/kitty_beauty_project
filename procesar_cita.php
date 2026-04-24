<?php
include 'db.php';

// Recibimos los datos
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$id_servicio = $_POST['id_servicio'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

// 1. Guardamos al cliente (Usando tus nombres de columna reales)
$sql_cliente = "INSERT INTO clientes (nombre_completo, telefono) VALUES ('$nombre', '$telefono')";

if ($conn->query($sql_cliente) === TRUE) {
    $id_cliente = $conn->insert_id;

    // 2. Guardamos la cita (id_cliente, id_servicio, fecha_cita, hora_cita, estado)
    $sql_cita = "INSERT INTO citas (id_cliente, id_servicio, fecha_cita, hora_cita, estado) 
                 VALUES ($id_cliente, $id_servicio, '$fecha', '$hora', 'Pendiente')";

    if ($conn->query($sql_cita) === TRUE) {
        $mostrar_exito = true;
    } else {
        echo "Error en cita: " . $conn->error; exit;
    }
} else {
    echo "Error en cliente: " . $conn->error; exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Cita Agendada! | Kitty Beauty</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .exito-card {
            text-align: center;
            padding: 50px 30px;
            max-width: 450px;
            margin: auto;
            border-radius: 40px; /* Bordes redondeados como en tu foto */
        }
        .flower-icon {
            font-size: 60px;
            margin-bottom: 20px;
            display: block;
        }
        h2 {
            font-family: 'Great Vibes', cursive;
            color: #d81b60;
            font-size: 4rem; /* Tamaño grande como en tu diseño */
            margin-bottom: 15px;
        }
        p {
            color: #37474f;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .btn-principal {
            display: block;
            background: #d81b60;
            color: white;
            padding: 15px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            margin-bottom: 15px;
            transition: 0.3s;
        }
        .btn-principal:hover { background: #ad1457; }
        
        .link-otra {
            color: #ad1457;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="sakura-container" id="sakura-container"></div>
    
    <div class="contenedor-formulario exito-card">
        <span class="flower-icon">🌸</span>
        <h2>¡Cita Agendada!</h2>
        <p>Gracias <strong><?php echo htmlspecialchars($nombre); ?></strong>, tu espacio ha sido reservado.</p>
        
        <a href="index.html" class="btn-principal">Volver al Inicio</a>
        <a href="index.php" class="link-otra">Agendar otra cita</a>
    </div>

    <script src="js/sakura.js"></script>
</body>
</html>