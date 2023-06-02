<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <title>DWES03_TAREA_FICHERO_crear.php</title>
</head>

<body class="card text-bg-info" style="border:none;"> <!--podemos remplazar esta clase con : style="background:aqua;"-->
  <div>
    <h1 class="m-5">Gestión de productos</h1>
  </div>

  <div class="container-sm w-100 mt-2">
    <?php
    //include 'crear.php';
    $servidor = "localhost";
    $usuario = "dev";
    $password = "mysql";
    $basedatos = "proyecto";
    
   //Establecer la conexión con MySQL

    try {
      $conexion = new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $password);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Conexión establecida...";
    } catch (PDOException $error) {
      echo "Error" . $error->getMessage();
    }

    // if($_POST)
    // {

    echo "<a href='crear.php?id=id' class='btn btn-success mb-2 mt-4' style='width:100px;'>Crear</a>"; //'{$_SERVER['PHP_SELF']}'
    // en crear hay que incluir insertar
    echo "<table class='table table-responsive-sm table-dark table-hover text-center table-striped '>";

    echo "<thead>";

    echo "<tr class='text-center font-weight-bold'>";
    echo " <th scop='col'>Detalle</th><th>Código</th><th>Nombre</th> <th scop='col'>Acción</th></tr>";

    echo "</thead>";

    echo "<tbody>";

    $consulta = $conexion->prepare("select id, nombre from productos");
    $consulta->execute();
    $resultado = $consulta->setFetchMode(PDO::FETCH_ASSOC); //aqui se encuentra el resultado 
    $filas = ($consulta->fetchAll());
    //print_r( $resultado);
    if (!$consulta->execute()) {
      die("Error al recuperar el Stock!!! o recuperar el producto!!! ");
    }

    foreach ($filas as $fila) {
      echo "<tr>";

      echo "<td><a href='detalle.php?id=" . $fila['id'] . "'><input type='submit' value='Detalle' class='btn btn-info float_l' /></a></td>
           
           <td class='text-center'> '{$fila['id']}'</td> 
           <td class='text-center'>'{$fila['nombre']}'</td>

           <td> <a href='update.php?id=" . $fila['id'] . "'><input type='submit'value='Actualizar'class='btn btn-warning float'/></a>
      
           <a href='borrar.php?id=" . $fila['id'] . "'><input type='submit' value='Borrar' class='btn btn-danger float'/></a></td>";

      // botón modificaaarr en el formulario 2 sera el de actualizar
      //   <!-- echo "<a href='borrar.php?id=" . $fila['id_objetivo'] . "'><button class='botonBorrar'>Borrar</button></a><strong>"; --> 
      echo "</tr>";
    }



    echo "</tbody>";
    echo "</table>";

    //$conexion->close();
    //pegar aqui else
    ?>
</body>

</html>