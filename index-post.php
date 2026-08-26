<?php
include("conexion.php");
$con = conexion();

$resultado = pg_query(
    $con,
    "SELECT table_schema, table_name
     FROM information_schema.tables
     WHERE table_name = 'persona'"
);

while ($fila = pg_fetch_assoc($resultado)) {
    echo $fila["table_schema"] . "." . $fila["table_name"];
}

exit;
?>