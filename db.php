<?php
$host = "db"; // El nombre que pusimos en el docker-compose
$usuario = "root";      
$password = "root";         
$base_datos = "kitty_beauty";
// En Docker no necesitas especificar el puerto 3307, usa el estándar
$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Fallo la conexión: " . $conn->connect_error);
}
?>