<?php
// Verificar si el archivo ha sido incluido desde otro archivo PHP
if (!isset($included)) {
  // Si se está accediendo directamente desde la URL, redirigir a la página de inicio o mostrar un mensaje de error
  header("Location: index.php"); // Cambia "index.php" por la página a la que quieres redirigir
  exit();
}

require_once 'conexion.php';
//Obtenerlo con GET o REQUEST
if ($_GET) {
  //Utilizar consultas parametrizadas
  //Sanitización de los datos para evitar los ataques XSS
  $id = htmlspecialchars($_GET['id']);
  //$id = $_GET['id'];
  $sql = $conexion->prepare("DELETE FROM productos WHERE id = ? ");
  if ($sql->execute([$id])) {
    print("producto con código: $id Borrado correctamente");
  } else {
    print("Fallido");
  }
}
echo "<form action='listado.php' method='POST'>";
echo '<br>';
echo "<button style='width:50px' value='volver' id='volver'>Volver</button>";
echo '</form>';
