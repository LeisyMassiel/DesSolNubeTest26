<?php
include("conexion.php");
$con = conexion();

$sql = "SELECT * FROM public.persona ORDER BY idpersona ASC";
$resultado = pg_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Lista de Personas</title>
</head>

<body>

    <h1>Lista de Personas Registradas</h1>

    <a href="index.php">Registrar nueva persona</a>

    <br><br>

    <table border="1">

        <tr>
            <th>ID</th>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Dirección</th>
            <th>Celular</th>
        </tr>

        <?php while ($fila = pg_fetch_assoc($resultado)) { ?>

        <tr>
            <td><?php echo $fila["idpersona"]; ?></td>
            <td><?php echo $fila["documento"]; ?></td>
            <td><?php echo $fila["nombre"]; ?></td>
            <td><?php echo $fila["apellido"]; ?></td>
            <td><?php echo $fila["direccion"]; ?></td>
            <td><?php echo $fila["celular"]; ?></td>
        </tr>

        <?php } ?>

    </table>

</body>
</html>