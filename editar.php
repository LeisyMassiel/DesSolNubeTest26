<?php
include("conexion.php");
$con = conexion();

if (!isset($_GET["id"])) {
    header("Location: listar.php");
    exit;
}

$id = intval($_GET["id"]);

$sql = "SELECT * FROM persona WHERE idpersona = $1";
$resultado = pg_query_params($con, $sql, array($id));

if (!$resultado || pg_num_rows($resultado) == 0) {
    die("Persona no encontrada");
}

$persona = pg_fetch_assoc($resultado);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Persona</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
        }

        .contenedor {
            width: 90%;
            max-width: 700px;
            margin: 60px auto;
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        h1 {
            text-align: center;
            color: #212529;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 11px;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
        }

        .botones {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .cancelar {
            background: #6c757d;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h1>Editar Persona</h1>

    <form action="actualizar.php" method="POST">

        <input type="hidden"
               name="id"
               value="<?php echo $persona['idpersona']; ?>">

        <label>Documento</label>
        <input type="text"
               name="doc"
               maxlength="8"
               value="<?php echo htmlspecialchars($persona['documento']); ?>"
               required>

        <label>Nombre</label>
        <input type="text"
               name="nom"
               value="<?php echo htmlspecialchars($persona['nombre']); ?>"
               required>

        <label>Apellido</label>
        <input type="text"
               name="ape"
               value="<?php echo htmlspecialchars($persona['apellido']); ?>"
               required>

        <label>Dirección</label>
        <input type="text"
               name="dir"
               value="<?php echo htmlspecialchars($persona['direccion']); ?>"
               required>

        <label>Celular</label>
        <input type="text"
               name="cel"
               maxlength="9"
               value="<?php echo htmlspecialchars($persona['celular']); ?>"
               required>

        <div class="botones">
            <button type="submit">
                Guardar cambios
            </button>

            <a href="listar.php" class="cancelar">
                Cancelar
            </a>
        </div>

    </form>

</div>

</body>
</html>