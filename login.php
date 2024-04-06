<?php
session_start(); // Iniciar la sesión al comienzo de cada página

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión
    require_once 'conexion.php';

    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultar la base de datos para verificar las credenciales
    $sql = $conexion->prepare("SELECT id, contrasena FROM usuarios WHERE nombre_usuario = ?");
    $sql->execute([$nombre_usuario]);
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Verificar la contraseña usando password_verify()
        if (password_verify($contrasena, $resultado['contrasena'])) {
            // Credenciales válidas, iniciar sesión y redirigir al usuario a la página principal
            $_SESSION['nombre_usuario'] = $nombre_usuario;
            header("Location: listado.php"); // Redirigir a la página principal
            exit();
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            echo "<p>Usuario o contraseña incorrectos. Inténtelo de nuevo.</p>";
        }
    } else {
        // Usuario no encontrado, mostrar mensaje de error
        echo "<p>Usuario o contraseña incorrectos. Inténtelo de nuevo.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Iniciar sesión</title>
</head>

<body>
    <div class="container-sm w-50 mt-5">
        <h2>Iniciar sesión</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>
</body>

</html>

