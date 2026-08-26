<?php
include("conexion.php");
$con = conexion();

$sql = "
SELECT
    current_database(),
    current_user,
    current_schema(),
    inet_server_addr()
";

$resultado = pg_query($con, $sql);
$fila = pg_fetch_assoc($resultado);

echo "Base de datos: " . $fila["current_database"] . "<br>";
echo "Usuario: " . $fila["current_user"] . "<br>";
echo "Esquema: " . $fila["current_schema"] . "<br>";
echo "Servidor: " . $fila["inet_server_addr"] . "<br>";
?>