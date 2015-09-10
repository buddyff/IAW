<?php
include ("../config.php");

//Obtengo los datos de la peticion
$id_turno = json_decode(file_get_contents("php://input"));

//Verifico si existe el registro turno-jugador
$query="SELECT * FROM turnos_jugadores WHERE id_turno={$id_turno} AND id_jugador={$_SESSION['user_id']}";
$resultado = mysql_query($query, $db);
$resultado= mysql_fetch_row($resultado);
$resultado=json_encode($resultado);

if($resultado=='false')
    echo 0;
else 
    echo 1;
?>