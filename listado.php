<?php
session_start(); // Iniciar la sesión al comienzo de cada página

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre_usuario'])) {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: iniciar_sesion.php");
    exit();
}

// Si el usuario ha iniciado sesión, mostrar el nombre de usuario y el botón de cerrar sesión
$nombre_usuario = $_SESSION['nombre_usuario'];

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Destruir todas las variables de sesión
    session_unset();
    // Destruir la sesión
    session_destroy();
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de productos</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body style="background:lightgrey;">
    <div class="container-fluid mt-5">
        <h2 class="text-center text-secondary fe-5">Gestión de productos</h1>
        <div class="text-end">
        <p class="text-secondary" style="font-weight:600">Bienvenido, <span class="text-secondary fe-5"><?php echo $nombre_usuario; ?></span> <span class="text-success fe-5">|</span> <a  style="text-decoration: none; font-weight:500;" class="text-primary" href="?logout=1">Cerrar sesión</a></p>
        </div>
    </div>

    <div class="container-sm w-100 mt-2">
        <?php
        //include 'crear.php';
        $servidor = "localhost";
        $usuario = "root";
        $password = "";
        $basedatos = "productos";

        //Establecer la conexión con MySQL

        try {
            $conexion = new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Conexión establecida...";
        } catch (PDOException $error) {
            echo "Error" . $error->getMessage();
        }

        echo "<a href='crear.php?id=id' class='btn btn-success mb-2 mt-4' style='width:100px;'>Crear</a>";
        echo "<table class='table table-responsive-sm table-dark table-hover text-center table-striped '>";

        echo "<thead>";

        echo "<tr class='text-center font-weight-bold'>";
        echo " <th scop='col'>Detalle</th><th>Código</th><th>Nombre</th> <th scop='col'>Acción</th></tr>";

        echo "</thead>";

        echo "<tbody>";

        $consulta = $conexion->prepare("select id, nombre from productos");
        $consulta->execute();
        $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC);
        $filas = ($consulta->fetchAll());
        //print_r( $resultado);
        if (!$consulta->execute()) {
            die("Error al recuperar el Stock!!! o recuperar el producto!!! ");
        }

        foreach ($filas as $fila) {
            echo "<tr>";

            echo "<td>
                <a href='detalle.php?id=" . $fila['id'] . "' class='btn btn-info float_l'>Detalle</a>
            </td>
            <td class='text-center'>" . $fila['id'] . "</td> 
            <td class='text-center'>" . $fila['nombre'] . "</td>
            <td>
                <a href='update.php?id=" . $fila['id'] . "' class='btn btn-warning float'>Actualizar</a>
                <a href='borrar.php?id=" . $fila['id'] . "' class='btn btn-danger float'>Borrar</a>
            </td>";

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        ?>
    </div>
</body>

</html>
