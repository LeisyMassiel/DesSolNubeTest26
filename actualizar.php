<?php

include("conexion.php");
$con = conexion();

$id  = $_POST["id"];
$doc = $_POST["doc"];
$nom = $_POST["nom"];
$ape = $_POST["ape"];
$dir = $_POST["dir"];
$cel = $_POST["cel"];

$sql = "UPDATE persona
        SET documento = $1,
            nombre = $2,
            apellido = $3,
            direccion = $4,
            celular = $5
        WHERE idpersona = $6";

$resultado = pg_query_params(
    $con,
    $sql,
    array($doc, $nom, $ape, $dir, $cel, $id)
);

if ($resultado) {
    header("Location: listar.php");
    exit;
} else {
    echo "Error al actualizar el registro.";
}

?>