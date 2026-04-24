<?php
include 'db.php';
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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body>

    <a href="index.html" style="position: fixed; top: 20px; left: 20px; text-decoration: none; color: #d81b60; font-weight: bold; z-index: 1000; font-family: sans-serif; background: rgba(255,255,255,0.8); padding: 8px 15px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">← Volver</a>

    <img src="arbol.png" class="arbol-sakura" alt="Decoración">

    <div class="contenedor-formulario">
        <h1 style="font-family: 'Great Vibes', cursive; color: #d81b60; text-align: center; margin-bottom: 15px; font-size: 28px;">Kitty Beauty</h1>
        
        <form action="procesar_cita.php" method="POST">
            
            <div class="campo">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" required placeholder="Tu nombre">
            </div>

            <div class="campo">
                <label>Teléfono</label>
                <input type="tel" name="telefono" required placeholder="866 123 4567">
            </div>

            <div class="campo">
                <label>Servicio</label>
                <select name="id_servicio" required>
                    <option value="">Selecciona un servicio</option>
                    <?php
                    if ($resultado && $resultado->num_rows > 0) {
                        while($fila = $resultado->fetch_assoc()) {
                            echo "<option value='".$fila['id_servicio']."'>".$fila['nombre_servicio']."</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="fila-doble">
                <div class="campo">
                    <label>Fecha</label>
                    <input type="date" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="campo">
                    <label>Hora</label>
                    <input type="time" name="hora" required>
                </div>
            </div>

            <button type="submit">Confirmar Cita</button>
        </form>
    </div>

    <script src="js/sakura.js"></script>
</body>
</html>