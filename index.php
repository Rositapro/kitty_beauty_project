<?php
// 1. CONEXIÓN: Asegúrate de que en db.php el host sea "db" y no tenga puerto 3307
include 'db.php';

// 2. LÓGICA: Consultamos los servicios para el menú
$sql = "SELECT * FROM servicios";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kitty Beauty - Agendar Cita</title>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fce4ec; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden; /* Evita que salgan barras de desplazamiento por los pétalos */
        }

        /* Contenedor principal con mayor prioridad visual */
        .contenedor-formulario {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(216, 27, 96, 0.2);
            width: 90%;
            max-width: 400px;
            position: relative;
            z-index: 100; /* Asegura que esté por encima de todo */
        }

        h1 {
            color: #d81b60;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ad1457;
            font-weight: bold;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #f8bbd0;
            border-radius: 10px;
            box-sizing: border-box;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #d81b60;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #ad1457;
            transform: scale(1.02);
        }

        /* Estilos del Árbol (Corregido para que no tape letras) */
        .arbol-sakura {
            position: fixed;
            bottom: -50px;
            right: -80px;
            width: 300px;
            z-index: 10; /* Detrás del formulario pero visible */
            opacity: 0.7;
            pointer-events: none;
        }

        /* Estilos de los pétalos */
        .sakura {
            position: fixed;
            top: -10%;
            z-index: 50;
            user-select: none;
            cursor: default;
            animation-name: fall;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
        }

        @keyframes fall {
            0% { top: -10%; transform: translateX(0) rotate(0deg); }
            100% { top: 110%; transform: translateX(100px) rotate(360deg); }
        }
    </style>
</head>
<body>

    <img src="https://www.transparentpng.com/download/sakura-tree/N7vXmY-sakura-tree-transparent-background.png" class="arbol-sakura">

    <div class="contenedor-formulario">
        <h1>🌸 Kitty Beauty 🌸</h1>
        <form action="procesar_cita.php" method="POST">
            <label>Nombre Completo:</label>
            <input type="text" name="nombre" required placeholder="Tu nombre">

            <label>Teléfono:</label>
            <input type="tel" name="telefono" required placeholder="Ej. 8661234567">

            <label>Servicio:</label>
            <select name="id_servicio" required>
                <option value="">-- Selecciona --</option>
                <?php
                if ($resultado && $resultado->num_rows > 0) {
                    while($fila = $resultado->fetch_assoc()) {
                        echo "<option value='".$fila['id_servicio']."'>".$fila['nombre_servicio']." - $".$fila['precio']."</option>";
                    }
                }
                ?>
            </select>

            <label>Fecha:</label>
            <input type="date" name="fecha" required min="<?php echo date('Y-m-d'); ?>">

            <label>Hora:</label>
            <input type="time" name="hora" required>

            <button type="submit">💖 Agendar Cita</button>
        </form>
    </div>

    <script>
        function createSakura() {
            const sakura = document.createElement('div');
            sakura.className = 'sakura';
            sakura.style.left = Math.random() * 100 + 'vw';
            sakura.style.width = Math.random() * 10 + 10 + 'px';
            sakura.style.height = sakura.style.width;
            sakura.style.backgroundColor = '#ffb7c5'; 
            sakura.style.borderRadius = '100% 0% 100% 0%';
            sakura.style.opacity = Math.random();
            sakura.style.animationDuration = Math.random() * 2 + 3 + 's';
            
            document.body.appendChild(sakura);
            setTimeout(() => { sakura.remove(); }, 5000);
        }
        setInterval(createSakura, 300);
    </script>
</body>
</html>