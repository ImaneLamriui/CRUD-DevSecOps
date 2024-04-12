<?php
// Incluir el archivo de conexión
require_once 'conexion.php';

// Definir las variables $error y $success para evitar errores de "undefined variable"
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y aplicar 
    //trim() eliminar los espacios en blanco adicionales alrededor del nombre de usuario y la contraseña
    $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']));
    $contrasena = htmlspecialchars(trim($_POST['contrasena']));
    

    // Validar longitud mínima y máxima para el nombre de usuario y la contraseña
    if (strlen($nombre_usuario) < 3 || strlen($nombre_usuario) > 20) {
        $error = "El nombre de usuario debe tener entre 3 y 20 caracteres.";
    } elseif (strlen($contrasena) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres.";
    } else {
        // Validar caracteres permitidos para el nombre de usuario y la contraseña
        if (!preg_match("/^[a-zA-Z0-9]+$/", $nombre_usuario)) {
            $error = "El nombre de usuario solo puede contener letras y números.";
        } elseif (!preg_match("/^[a-zA-Z0-9@#$%^&*]+$/", $contrasena)) {
            $error = "La contraseña solo puede contener letras, números y los siguientes caracteres especiales: @ # $ % ^ & *";
        } else {
            // Hash de la contraseña
            $hash_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);

            // Preparar la consulta SQL para verificar si el usuario ya existe
            $sql_verificar = $conexion->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ?");
            $sql_verificar->execute([$nombre_usuario]);
            $resultado_verificar = $sql_verificar->fetch(PDO::FETCH_ASSOC);

            if ($resultado_verificar) {
                // Si el usuario ya existe, mostrar un mensaje de error
                $error = "El usuario ya existe.";
            } else {
                // Preparar la consulta SQL para insertar el usuario en la base de datos
                $sql_insertar = $conexion->prepare("INSERT INTO usuarios (nombre_usuario, contrasena) VALUES (?, ?)");

                // Ejecutar la consulta con los valores correspondientes
                if ($sql_insertar->execute([$nombre_usuario, $hash_contrasena])) {
                    $success = "Usuario registrado correctamente.";
                } else {
                    $error = "Error al registrar el usuario.";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f8f9fa;"> <!-- Color de fondo para todo el cuerpo del documento -->

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Registro de Usuario
                    </div>
                    <div class="card-body" style="background-color: #f0f0f0;"> <!-- Color de fondo para el cuerpo del formulario -->
                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($success) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $success; ?>
                            </div>
                        <?php endif; ?>
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="nombre_usuario" class="form-label">Nombre de usuario:</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label">Contraseña:</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>