<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>detalle.php</title>
</head>

<body class="card text-bg-info" style="border:none;"> <!--podemos remplazar esta clase con : style="background:aqua;"-->


    <div>
        <h1 class="m-3">Detalle producto</h1>
    </div>

    <div class="container-sm w-100">
        <?php

        require_once 'conexion.php';

        if ($_GET) {
            // utilizar consultas preparadas con marcadores de posición para protegerse de la Inyección SQL
            //$id = $_GET['id'];
            //Sanitización de Datos, asegurar de que los datos mostrados en el formulario estén debidamente escapados para prevenir posibles ataques XSS
            $id = htmlspecialchars($_GET['id']);

            $sql = $conexion->prepare("SELECT nombre,nombre_corto,descripcion,pvp,familia  FROM productos WHERE id = ?");
            $sql->execute([$id]);

            $detalles1 = $sql->fetchAll(PDO::FETCH_ASSOC);

            // $consulta3 = $conexion->prepare("select cod, nombre from familias WHERE cod= $id");
            // $consulta3->execute();
            // $detalles2 = $consulta3->fetchAll();

            foreach ($detalles1 as $detalle) {

                echo '<br>';
                // echo ("<h4>{$detalle['nombre']}<br></h4>");
                echo ("<h4>" . htmlspecialchars($detalle['nombre']) . "<br></h4>");

                echo ("<h5>Código: $id<br></h5>");
                echo ("<i style='font-style:normal;font-weight: bold;color: white;'>Nombre </i>: " . $detalle['nombre'] . '<br>');
                echo ("<i style='font-style:normal;font-weight: bold;color: white;'>Nombre corto </i>: " . $detalle['nombre_corto'] . '<br>');
                echo ("<i style='font-style:normal;font-weight: bold;color: white;'>PVP </i>: " . $detalle['pvp'] . '€' . '<br>');
                echo ("<i style='font-style:normal;font-weight: bold;color: white;'>Código familia </i>: " . $detalle['familia'] . '<br>');
                echo ("<i style='font-style:normal;font-weight: bold;color: white;'>Descripcion </i>: " . $detalle['descripcion'] . '<br>');
            }
            echo "<form action='listado.php' method='POST'>";
            echo '<br>';
            echo "<button style='width:100px' value='volver' id='volver'>Volver</button>";
            echo '</form>';
        }


        ?>


    </div>
</body>

</html>