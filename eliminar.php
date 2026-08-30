<?php

include("conexion.php");

$con = conexion();

if (!isset($_GET["id"])) {header("Location: listar.php");

    exit;

}

$id = $_GET["id"];

$sql = "DELETE FROM public.persona
        WHERE idpersona = $1";

$resultado = pg_query_params(
    $con,$sql,array($id));

if ($resultado) {

    header("Location: listar.php?mensaje=eliminado");

    exit;

} else {

    echo "Error al eliminar el registro.";

}

?>