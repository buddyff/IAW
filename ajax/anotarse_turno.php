<?php
include ("../config.php");

//Obtengo los datos de la peticion
$id_turno = json_decode(file_get_contents("php://input"));

//Aumento en uno la cantidad de inscriptos en el turno
$query = "UPDATE turnos SET inscriptos=inscriptos+1 WHERE id={$id_turno}";
$resultado = mysql_query($query, $db);

//Registro al jugador en el turno
$query="INSERT INTO turnos_jugadores (id_turno,id_jugador) VALUES ({$id_turno},{$_SESSION['user_id']})";
$resultado = mysql_query($query, $db);

?>