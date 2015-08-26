<?php
include ("../config.php");

//Obtengo los datos de la peticion
$datos = json_decode(file_get_contents("php://input"));

$query = "SELECT * FROM jugadores WHERE Email='{$datos->email}' and Pass='{$datos->pass}'";

$resultado = mysql_query($query, $db);
$resultado=  mysql_fetch_assoc($resultado);

if($resultado)
    echo 1;
else
    echo 0;

?>