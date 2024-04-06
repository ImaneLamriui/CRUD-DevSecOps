<?php

//Crear las variables de conexión a MySQL
$servidor = "localhost";
$usuario = "root";
$password = "";
$basedatos = "productos";

//Establecer la conexión con MySQL

try {
	$conexion = new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $password);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo"Conexión establecida...";
} catch (PDOException $error) {
	echo "Error" . $error->getMessage();
}

//Seleccionamos la Base de Datos
//mysqli_select_db($conexion,$basedatos); -->
?>
<!-- 
	 Otro usuario 
	 $servidor = "localhost";
	 $usuario = "dev";
	 $pass = "mysql";
	 $basedatos = "proyecto";
	 $conexion = mysqli_connect($servidor,$usuario,$pass) or die("Error de conexión");
	 mysqli_select_db($conexion,$basedatos); 
-->