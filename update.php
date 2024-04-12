<?php
require_once 'conexion.php';

session_start(); // Iniciar la sesión si aún no está iniciada

// Validar la URL de redirección si existe el parámetro "redirect"
if (isset($_GET['redirect'])) {
    $redirect_url = $_GET['redirect'];
    // Validar que la URL de redirección sea segura (por ejemplo, permitir solo dominios específicos)
    $allowed_domains = array('example.com', 'example.org'); // Lista de dominios permitidos
    $parsed_url = parse_url($redirect_url);
    if (isset($parsed_url['host']) && in_array($parsed_url['host'], $allowed_domains)) {
        // Redirigir al usuario solo si la URL de redirección es segura
        header("Location: " . $redirect_url);
        exit;
    } else {
        // Si la URL de redirección no es segura, muestra un mensaje de error o redirige a una página predeterminada
        echo "La URL de redirección no es válida.";
        exit;
    }
}

// Verificar si se recibió un POST y validar el método de solicitud HTTP
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID del producto desde la URL
    if (!isset($_GET['id'])) {
        // Si no se proporciona un ID, mostrar un mensaje de error o redirigir a una página predeterminada
        echo "No se proporcionó un ID válido.";
        exit;
    }
    $id = htmlspecialchars($_GET['id']);

    // Obtener los datos del formulario y validarlos
    $detalle['nombre'] = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $detalle['nombre_corto'] = isset($_POST['nombre_corto']) ? htmlspecialchars($_POST['nombre_corto']) : '';
    $detalle['descripcion'] = isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion']) : '';
    $detalle['pvp'] = isset($_POST['pvp']) ? htmlspecialchars($_POST['pvp']) : '';
    $detalle['familia'] = isset($_POST['familia']) ? htmlspecialchars($_POST['familia']) : '';

    // Preparar la consulta SQL con marcadores de posición para evitar la inyección SQL
    $sql = $conexion->prepare("UPDATE productos SET nombre = ?, nombre_corto = ?, descripcion = ?, pvp = ?, familia = ? WHERE id = ?");

    // Ejecutar la consulta con los valores correspondientes
    if ($sql->execute([$detalle['nombre'], $detalle['nombre_corto'], $detalle['descripcion'], $detalle['pvp'], $detalle['familia'], $id])) {
        // Si la consulta se ejecuta correctamente
        $_SESSION['mensaje'] = "Producto actualizado correctamente.";
        echo "<script>alert('Producto actualizado correctamente.'); window.location.href='listado.php';</script>";
    } else {
        // Si la consulta falla
        $_SESSION['mensaje'] = "Error al actualizar el producto.";
        echo "<script>alert('Error al actualizar el producto.'); window.location.href='listado.php';</script>";
    }
}

// Si no se redirige ni se procesa un formulario POST, entonces se muestra el formulario HTML
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>update.php</title>
</head>

<body class="card text-bg-info" style="border:none;">

    <div>
        <h1 class="m-3 mt-3">Modificar producto</h1>
    </div>

    <div class="container-sm w-50">
        <form action="" method="POST">
            <?php
            if ($_GET) {
                $id = htmlspecialchars($_GET['id']);

                $sql = $conexion->prepare("SELECT nombre, nombre_corto, descripcion, pvp, familia FROM productos WHERE id = ?");
                $sql->execute([$id]);

                $detalles1 = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach ($detalles1 as $detalle) {
                    echo "<div class='row md-3 mt-3'>";
                    echo "<div class='col'>";
                    echo "<label for='nombre'>Nombre</label><br>";
                    echo "<input style='width:100%;' name='nombre' id='nombre' type='text' placeholder='nombre' value='{$detalle['nombre']}'></div>";

                    echo "<div class='col'>";
                    echo "<label for='nombrecorto'>Nombre Corto</label><br>";
                    echo "<input style='width:100%;' name='nombre_corto' id='nombre_corto' type='text' placeholder='nombreCorto' value='{$detalle['nombre_corto']}'></div>";
                    echo "</div>";

                    echo "<div class='row md-3 mt-3'>";
                    echo "<div class='col'>";
                    echo "<label for='pvp'>PVP</label><br>";
                    echo "<input name='pvp' id='pvp' type='text' placeholder='pvp' value='{$detalle['pvp']}' style='width:100%;'>";
                    echo "</div>";
                    echo "<div class='col'>";
                    echo "<label for='familia'>Familias</label>";
                    echo "<select class='familias' id='familia' name='familia' style='width:100%;height: 30px;'>";
                    echo "<option selected='yes' value='{$detalle['familia']}'>" . $detalle['familia'] . "</option>";

                    $consulta3 = $conexion->prepare("select cod, nombre from familias order by cod");
                    $consulta3->execute();
                    $consulta3->setFetchMode(PDO::FETCH_ASSOC);
                    $familias = $consulta3->fetchAll();

                    foreach ($familias as $fila) {
                        echo "<option value='{$fila['nombre']}'>" . $fila['nombre'] . "</option>";
                    }
                    echo "</optgroup>";
                    echo " </select>  </div>";
                    echo "</div>";

                    echo "<div class='row md-3 mt-3'>";
                    echo "<div class='col'>";
                    echo "<label for='descripcion' class='form-label mt-3'>Descripcion</label>";
                    echo "<textarea style='height:130px;'  class='form-control' name='descripcion' id='descripcion' >{$detalle['descripcion']}</textarea></div></div>";

                    echo "<div class='row md-5 mt-5'>";
                    echo "<p class='mt-5'>";
                    echo "<input type='submit' class='botones_update btn btn-success mt-5' value='Volver' name='Volver'>";
                    echo "<input type='submit' class='botones_update btn btn-success mt-5 me-3' value='Modificar'  name='Modificar'>";
                    echo "</p>";
                    echo "</div>";
                }
            }
            ?>
        </form>
    </div>
</body>

</html>
