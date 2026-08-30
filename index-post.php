<?php

include("conexion.php");

$con = conexion();

$doc = $_POST["doc"];
$nom = $_POST["nom"];
$ape = $_POST["ape"];
$dir = $_POST["dir"];
$cel = $_POST["cel"];

$sql = "INSERT INTO public.persona
        (documento, nombre, apellido, direccion, celular)
        VALUES ($1, $2, $3, $4, $5)";

$resultado = pg_query_params(
    $con,
    $sql,
    array(
        $doc,$nom,$ape,$dir,$cel
    )
);

if ($resultado) {

    header("Location: listar.php");

    exit;

} else {

    echo "Error al registrar la persona.";

}

?>