<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>update.php</title>
</head>

<body class="card text-bg-info" style="border:none;"> <!--podemos remplazar esta clase con : style="background:aqua;"-->

  <div>
    <h1 class="m-3">Modificar producto</h1>
  </div>
  <div class="container-sm w-50">

    <form action="" method="POST">

      <?php

      require_once 'conexion.php';

      if ($_GET) {
        //Sanitización del código para evitar ataques XSS
        //$id = $_GET['id'];
        $id = htmlspecialchars($_GET['id']);
        //utilizar las consultas parametrizadas
        $sql = $conexion->prepare("SELECT nombre,nombre_corto,descripcion,pvp,familia  FROM productos WHERE id = ?");
        $sql->execute([$id]);
        //$sql->execute();


        $detalles1 = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($detalles1 as $detalle) {
          echo "<br><h5>" . htmlspecialchars($detalle['nombre']) . " , id: $id</h5><br>";
          //echo "<br><h5>{$detalle['nombre']} , id : $id</h5><br>";
        }
        echo "<div class='row m-3'>";
        echo "<div class='col'>";
        echo "<label for='nombre' >Nombre</label></br>";
        echo "<input style='width:100%;' name='nombre' id='nombre' type='text' placeholder='nombre' value='{$detalle['nombre']}'></div>";

        echo "<div class='col'>";
        echo "<label for='nombrecorto' class='font-weight-bold'></label>Nombre Corto</br>";
        echo "<input style='width:100%;' name='nombre_corto' id='nombre_corto'  type='text' placeholder='nombreCorto' value='{$detalle['nombre_corto']}'></div>";
        echo "</div>";
        //echo"</br>";
        echo "<div class='row m-3'>";
        echo "<div class='col'>";
        echo " <label for='pvp' >PVP</label></br>";
        echo "<input name='pvp' id='pvp'  type='text' placeholder='pvp' value='{$detalle['pvp']}' style='width:100%;'>";
        //print_r('<br>'.$detalle['pvp']);
        echo "</div>";
        echo "<div class='col'>";
        echo "<label for='familia' class=''>Familias</label>";
        echo "<select class='familias' id='familia' name='familia' style='width:100%;height: 30px;'>";

        echo "<option selected='yes' value='{$detalle['familia']}'>" . $detalle['familia'] . "</option>";

        $consulta3 = $conexion->prepare("select cod, nombre from familias order by cod");
        $resultado3 = $consulta3->execute();
        $resultado3 = $consulta3->setFetchMode(PDO::FETCH_ASSOC);
        $familias = $consulta3->fetchAll();

        foreach ($familias as $fila) {

          echo "<option value='{$fila['nombre']}'>" . $fila['nombre'] . "</option>";
        } //construir 
        echo "</optgroup>";
        echo " </select>  </div>";
        echo "</div>";
        //echo"</br>";

        echo "<div class='row m-3'>";
        echo "<div class='col'>";
        echo "<label for='descripcion' class='form-label'>Descripcion</label>";
        echo "<textarea style='height:200px;'  class='form-control' name='descripcion' id='descripcion' >{$detalle['descripcion']}</textarea>
          
          <div class='row mt-3'>";
        echo "<div class='col'>";
        echo '</div> </div>';
        echo "<div style='margin:0px;'class='row'>";

        echo "<p class='text-center'>";
        //print_r($detalle['descripcion']);
      ?>
        <form action="listado.php" method="POST">

          <input type='submit' class='botones_update btn btn-success' value='Modificar' name='Modificar'>
          <input type='submit' class='botones_update btn btn-success me-2' value='Volver' name='Volver'>
        </form>

  </div>

<?php

      };

      // Incluir el archivo de conexión
      require_once 'conexion.php';

      // Verificar si se recibió un POST
      if ($_POST) {
        // Obtener el ID del producto desde la URL
        $id = $_GET['id'];

        // Obtener los datos del formulario
        $detalle['nombre'] = $_POST['nombre'];
        $detalle['nombre_corto'] = $_POST['nombre_corto'];
        $detalle['descripcion'] = $_POST['descripcion'];
        $detalle['pvp'] = $_POST['pvp'];
        $detalle['familia'] = $_POST['familia'];

        // Preparar la consulta SQL con marcadores de posición
        $sql = $conexion->prepare("UPDATE productos SET nombre = ?, nombre_corto = ?, descripcion = ?, pvp = ?, familia = ? WHERE id = ?");

        // Ejecutar la consulta con los valores correspondientes
        session_start(); // Iniciar la sesión si aún no está iniciada

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
?>


</form>
</div>
</body>

</html>