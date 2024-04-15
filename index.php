<?php
// Iniciar la sesión al comienzo de cada página
session_start();
// Aplicar configuraciones de seguridad de sesión
//ini_set('session.cookie_secure', 1);
//ini_set('session.cookie_httponly', 1);
//ini_set('session.gc_maxlifetime', 1800); // Tiempo de expiración de sesión en 30 minutos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión
    require_once 'conexion.php';

    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consultar la base de datos para verificar las credenciales
    $sql = $conexion->prepare("SELECT id, contrasena, intentos_fallidos, bloqueo_temporal FROM usuarios WHERE nombre_usuario = ?");
    $sql->execute([$nombre_usuario]);
    $resultado = $sql->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        // Verificar el bloqueo temporal
        //time() es una función que calcula la diferencia entre dos momentos 
        if ($resultado['bloqueo_temporal'] && strtotime($resultado['bloqueo_temporal']) > time()) {
            // Cuenta bloqueada temporalmente
            echo "<p>Cuenta bloqueada temporalmente. Inténtelo de nuevo más tarde.</p>";
        } else {
            // Verificar la contraseña usando la función password_verify()
            if (password_verify($contrasena, $resultado['contrasena'])) {
                // Restablecer el contador de intentos fallidos
                $sql_reset_intentos = $conexion->prepare("UPDATE usuarios SET intentos_fallidos = 0 WHERE id = ?");
                $sql_reset_intentos->execute([$resultado['id']]);
                // Si la cuenta estaba bloqueada temporalmente, restablecerla
                if ($resultado['bloqueo_temporal']) {
                    $sql_reset_block = $conexion->prepare("UPDATE usuarios SET bloqueo_temporal = NULL WHERE id = ?");
                    $sql_reset_block->execute([$resultado['id']]);
                }
                // Iniciar sesión y redirigir al usuario a la página principal listado.php
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                header("Location: listado.php");
                exit();
            } else {
                // Incrementar el contador de intentos fallidos
                $intentos_fallidos = $resultado['intentos_fallidos'] + 1;
                $sql_update_intentos = $conexion->prepare("UPDATE usuarios SET intentos_fallidos = ? WHERE id = ?");
                $sql_update_intentos->execute([$intentos_fallidos, $resultado['id']]);
                // Si se supera el límite de intentos fallidos, establecer el bloqueo temporal
                if ($intentos_fallidos >= 2) {
                    // Bloquear la cuenta durante 30 minutos
                    $bloqueo_temporal = date('Y-m-d H:i:s', strtotime('+30 minutes'));

                    $sql_block = $conexion->prepare("UPDATE usuarios SET bloqueo_temporal = ? WHERE id = ?");
                    //ejecuta la consulta preparada previamente con PDO
                    //$sql_block es una instancia de la clase PDOStatement (de la consulta preparada prepare())
                    //[$bloqueo_temporal, $resultado['id']] este es un array que:
                    //apunta al tiempo de bloqueo y al id de la cuenta del usuario
                    $sql_block->execute([$bloqueo_temporal, $resultado['id']]);
                }
                echo "<p>Usuario o contraseña incorrectos. Inténtelo de nuevo.</p>";
            }
        }
    } else {
        // Usuario no encontrado o no registrado en la base de datos, mostrar mensaje de error
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

<body class="bg-light" style="padding: 70px;">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6 col-sm-12" style="max-width: 500px;">
                <div class="card" style="height: 400px;">
                    <div class="card-header text-center" style="font-weight: 600; font-size:larger;">
                        Iniciar sesión
                    </div>
                    <div class="card-body pb-0 text-start" style="background-color: #f0f0f0;">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="mb-3">
                                <label for="nombre_usuario" class="form-label" style="font-weight: 400" ;>Nombre de usuario</label>
                                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="" required>
                            </div><br>
                            <div class="mb-3">
                                <label for="contrasena" class="form-label" style="font-weight: 400" ;>Contraseña</label>
                                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                            </div>
                            <p style="text-align:center;">
                                <button type="submit" class="mt-5 text-center btn btn-primary">Iniciar sesión</button>
                            </p>
                        </form>

                        <span class="text-center" style="font-weight: 400" ;><p class="text-center;">¿Aún no te has registrado? <a href="registro.php" style="font-weight: 400;">Registrate</a></p></span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>