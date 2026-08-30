<?php
include("conexion.php");
$con = conexion();

$buscar = isset($_GET["buscar"]) ? trim($_GET["buscar"]) : "";

if ($buscar != "") {

    $sql = "SELECT * FROM public.persona
            WHERE documento ILIKE $1
               OR nombre ILIKE $1
               OR apellido ILIKE $1
               OR direccion ILIKE $1
               OR celular ILIKE $1
            ORDER BY idpersona ASC";

    $resultado = pg_query_params($con,$sql,array("%" . $buscar . "%") );

} else {

    $sql = "SELECT * FROM public.persona
            ORDER BY idpersona ASC";

    $resultado = pg_query($con, $sql);
}

$total = pg_num_rows($resultado);

$mensaje = isset($_GET["mensaje"]) ? $_GET["mensaje"] : "";
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Lista de Personas</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
        }

        .contenedor {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .logo {
            text-align: center;
        }

        .logo img {
            width: 90px;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        .total {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        .mensaje {
            padding: 12px;
            margin-bottom: 20px;
            background-color: #d1e7dd;
            border-radius: 6px;
            text-align: center;
        }

        .barra {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .boton {
            padding: 10px 16px;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            display: inline-block;
        }

        .nuevo {
            background-color: #198754;
        }

        .editar {
            background-color: #0d6efd;
        }

        .eliminar {
            background-color: #dc3545;
        }

        .mostrar {
            background-color: #6c757d;
        }

        .buscador {
            display: flex;
            gap: 5px;
        }

        .buscador input {
            padding: 10px;
            width: 250px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .buscador button {
            background-color: #0d6efd;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #212529;
            color: white;
            padding: 12px;
        }

        td {
            padding: 11px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .sin-datos {
            padding: 25px;
            color: #777;
        }

        .acciones {
            display: flex;
            justify-content: center;
            gap: 5px;
        }

        @media(max-width: 768px) {

            .contenedor {
                width: 95%;
                padding: 15px;
            }

            .tabla {
                overflow-x: auto;
            }

            .buscador {
                width: 100%;
            }

            .buscador input {
                flex: 1;
            }

        }

    </style>

</head>

<body>

<div class="contenedor">

    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>

    <h1>Personas Registradas</h1>

    <div class="total">

        Total de registros encontrados:

        <strong>
            <?php echo $total; ?>
        </strong>

    </div>

    <?php if ($mensaje == "actualizado") { ?>

        <div class="mensaje">
            Registro actualizado correctamente.
        </div>

    <?php } ?>

    <?php if ($mensaje == "eliminado") { ?>

        <div class="mensaje">
            Registro eliminado correctamente.
        </div>

    <?php } ?>

    <div class="barra">

        <div>

            <a
                href="index.php"
                class="boton nuevo"
            >
                + Nueva persona
            </a>

            <a
                href="listar.php"
                class="boton mostrar"
            >
                Mostrar todos
            </a>

        </div>

        <form
            action="listar.php"
            method="GET"
            class="buscador"
        >

            <input
                type="text"
                name="buscar"
                placeholder="Buscar persona..."
                value="<?php echo htmlspecialchars($buscar); ?>"
            >

            <button type="submit">
                Buscar
            </button>

        </form>

    </div>

    <div class="tabla">

        <table>

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                    <th>Acciones</th>

                </tr>

            </thead>

            <tbody>

            <?php if ($total > 0) { ?>

                <?php while ($fila = pg_fetch_assoc($resultado)) { ?>

                    <tr>

                        <td>
                            <?php echo $fila["idpersona"]; ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($fila["documento"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($fila["nombre"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($fila["apellido"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($fila["direccion"]); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($fila["celular"]); ?>
                        </td>

                        <td>

                            <div class="acciones">

                                <a
                                    class="boton editar"
                                    href="editar.php?id=<?php echo $fila["idpersona"]; ?>"
                                >
                                    Editar
                                </a>

                                <a
                                    class="boton eliminar"
                                    href="eliminar.php?id=<?php echo $fila["idpersona"]; ?>"
                                    onclick="return confirm('¿Deseas eliminar este registro?');"
                                >
                                    Eliminar
                                </a>

                            </div>

                        </td>

                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td
                        colspan="7"
                        class="sin-datos"
                    >
                        No se encontraron registros.
                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>