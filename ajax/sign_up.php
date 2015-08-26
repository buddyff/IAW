<?php
include ("../config.php");

//Obtengo los datos de la peticion
$datos = json_decode(file_get_contents("php://input"));

$nombre = $datos->nombre;
$apellido = $datos->apellido;
$edad = $datos->edad;
$direccion= $datos->direccion;
$telefono = $datos ->telefono;
$email = $datos->email;
$password = $datos->password;

$query = "INSERT INTO jugadores (Nombre,Apellido,Telefono,Direccion,Edad,Email,Pass) VALUES ('{$nombre}','{$apellido}','{$telefono}','{$direccion}','{$edad}','{$email}','{$password}')";

$resultado = mysql_query($query, $db);

if($resultado)
    echo 1;
else
    echo 0;

?>