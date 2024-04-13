<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['nombre_usuario'])) {
    // Si el usuario ha iniciado sesión, destruir la sesión al hacer clic en "Cerrar sesión"
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        // Destruir todas las variables de sesión
        session_unset();
        // Destruir la sesión
        session_destroy();
        // Redirigir al usuario a la página de inicio de sesión u otra página deseada
        header("Location: index.php");
        exit();
    }
} else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerrar sesión</title>
</head>

<body>
    <div>
        <h2>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?></h2>
        <p><a href="?logout=1">Cerrar sesión</a></p>
    </div>
</body>

</html>
