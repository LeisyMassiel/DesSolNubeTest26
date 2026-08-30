<?php
include("conexion.php");
$con = conexion();

$sql = "SELECT * FROM public.persona ORDER BY idpersona ASC";
$resultado = pg_query($con, $sql);

$total = pg_num_rows($resultado);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            max-width: 1100px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        h1 {
            text-align: center;
            color: #222;
            margin-bottom: 10px;
        }

        .total {
            text-align: center;
            color: #666;
            margin-bottom: 25px;
        }

        .botones {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .btn-nuevo {
            background-color: #198754;
        }

        .btn-actualizar {
            background-color: #0d6efd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 8px;
        }

        th {
            background-color: #212529;
            color: white;
            padding: 13px;
        }

        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        .sin-registros {
            text-align: center;
            padding: 25px;
            color: #777;
        }

        @media (max-width: 768px) {
            .contenedor {
                width: 95%;
                padding: 15px;
            }

            .tabla-responsive {
                overflow-x: auto;
            }

            .botones {
                flex-direction: column;
                align-items: stretch;
            }

            .btn {
                text-align: center;
            }
        }
    </style>

</head>

<body>

<div class="contenedor">

    <div class="logo">
        <img src="logo.png" alt="Logo">
    </div>

    <h1>Lista de Personas Registradas</h1>

    <div class="total">
        Total de personas registradas:
        <strong><?php echo $total; ?></strong>
    </div>

    <div class="botones">

        <a href="index.php" class="btn btn-nuevo">
            + Registrar nueva persona
        </a>

        <a href="listar.php" class="btn btn-actualizar">
            Actualizar lista
        </a>

    </div>

    <div class="tabla-responsive">

        <table>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Celular</th>
                </tr>
            </thead>

            <tbody>

            <?php if ($total > 0) { ?>

                <?php while ($fila = pg_fetch_assoc($resultado)) { ?>

                    <tr>
                        <td><?php echo $fila["idpersona"]; ?></td>
                        <td><?php echo htmlspecialchars($fila["documento"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["apellido"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["direccion"]); ?></td>
                        <td><?php echo htmlspecialchars($fila["celular"]); ?></td>
                    </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6" class="sin-registros">
                        No existen personas registradas.
                    </td>
                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>

</html>git add .