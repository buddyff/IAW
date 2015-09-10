<?php
include ("../config.php");

//Obtengo los datos de la peticion
$id_turno = json_decode(file_get_contents("php://input"));

//Decremento en uno la cantidad de inscriptos en el turno
$query = "UPDATE turnos SET inscriptos=inscriptos-1 WHERE id={$id_turno}";
$resultado = mysql_query($query, $db);

//Saco el registro del jugador en el turno
$query="DELETE FROM turnos_jugadores WHERE id_turno={$id_turno} AND id_jugador={$_SESSION['user_id']} ";
$resultado = mysql_query($query, $db);

?>