<?php
// 1. CONEXIÓN: Asegúrate de que db.php esté configurado para Docker (host: "db")
include 'db.php';

// 2. LÓGICA: Consultar servicios
$sql = "SELECT * FROM servicios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitty Beauty - Agendar Cita</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <img src="arbol.png" class="ramas-sakura" alt="Ramas de Sakura">

    <div class="contenedor-formulario">
        <h1> Kitty Beauty </h1>
        <form action="procesar_cita.php" method="POST">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">

            <label for="telefono">Teléfono:</label>
            <input type="tel" id="telefono" name="telefono" required placeholder="Ej. 8661234567">

            <label for="servicio">¿Qué te gustaría hacerte?</label>
            <select id="servicio" name="id_servicio" required>
                <option value="">-- Selecciona --</option>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        echo "<option value='".$fila['id_servicio']."'>".$fila['nombre_servicio']." - $".$fila['precio']."</option>";
                    }
                }
                ?>
            </select>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d'); ?>">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>

            <button type="submit">Agendar Cita</button>
        </form>
    </div>

    <script src="js/sakura.js"></script>
</body>
</html>