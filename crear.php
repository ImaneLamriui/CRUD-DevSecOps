<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>crear.php</title>
</head>



<body class="card text-bg-danger" style="border:none;"> <!--podemos remplazar esta clase con : style="background:aqua;"-->


  <div>
    <h1 class="m-5 text-center">Crear producto</h1>
  </div>

  <div class="container w-50">

    <form class="" action="" method="POST">

      <div class="row">
        <div class="col-md-6">
          <label for="nombre">Nombre</label></br>
          <input name="nombre" id="nombre" type="text" placeholder="nombre" style="width: 100%;">
        </div>
        <div class=" col-md-6">
          <label for="nombrecorto" class="font-weight-bold"></label>Nombre Corto</br>
          <input name="nombre_corto" id="nombre_corto" type="text" placeholder="nombreCorto" style="width: 100%;">
        </div>
      </div>
      </br>
      <div class="row">
        <div class="col-md-6">
          <label for="pvp">PVP</label></br>
          <input name="pvp" id="pvp" type="text" placeholder="pvp" style="width: 100%;">
        </div>
        <div class="col-md-6">
          <label for="familia" class="">Familias</label>
          <select class="familias" id="familia" name="familia" style="width: 100%; height:30px;">


            <?php
            require_once 'conexion.php';
            //  <?php echo $_SERVER['PHP_SELF']; 
            $consulta3 = $conexion->prepare("select cod, nombre from familias order by cod");
            $resultado3 = $consulta3->execute();
            $resultado3 = $consulta3->setFetchMode(PDO::FETCH_ASSOC);
            $familias = $consulta3->fetchAll();

            foreach ($familias as $fila) {
              echo "<option value='" . htmlspecialchars($fila['cod']) . "'>" . htmlspecialchars($fila['nombre']) . "</option>";
              // "<option value='{$fila['cod']}'>" . $fila['nombre'] . "</option>";
            }
            ?>
          </select>
        </div>
      </div>
      </br>

      <div class="row">
        <div class="col-md-12">
          <label for="descripcion" class="form-label">Descripcion</label>
          <textarea class="form-control" name="descripcion" id="descripcion" rows="3" style="width: 100%;"></textarea>


          <div class="row mt-5">

            <p class="text-center">
              <a><input type="submit" class="btn btn-primary m-2" value="Crear" name="Crear"></a>
              <input type="reset" class="btn btn-primary m-2" value="Limpiar" name="Limpiar">
              <input type="submit" class="btn btn-primary m-2" value="Volver" name="Volver">
            </p>
          </div>

          <?php
          require_once 'conexion.php';
          // evitar la ejecución del código de inserción si no se ha enviado el formulario.
          // Sanitización del código para prevenir ataques XSS
          if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nombre = htmlspecialchars($_POST['nombre']);
            $nombre_corto = htmlspecialchars($_POST['nombre_corto']);
            $descripcion = htmlspecialchars($_POST['descripcion']);
            $pvp = htmlspecialchars($_POST['pvp']);
            $familia = htmlspecialchars($_POST['familia']);

            $consulta = $conexion->prepare("INSERT INTO productos (nombre, nombre_corto, descripcion, pvp, familia) VALUES (?, ?, ?, ?, ?)");
            $consulta->execute([$nombre, $nombre_corto, $descripcion, $pvp, $familia]);

            if ($consulta->rowCount() > 0) {
              echo "Registro agregado correctamente.";
            } else {
              echo "Error al agregar el registro.";
            }
            // Ejecutar la consulta con los valores correspondientes
            if ($consulta->execute()) {
              // Si la consulta se ejecuta correctamente
              $_SESSION['mensaje'] = "Producto creado correctamente.";
              echo "<script>alert('Producto creado correctamente.'); window.location.href='listado.php';</script>";
            } else {
              // Si la consulta falla
              $_SESSION['mensaje'] = "Error al crear el producto.";
              echo "<script>alert('Error al crear el producto.'); window.location.href='listado.php';</script>";
            }
          }
          ?>
    </form>

  </div>
</body>

</html>