<?php
include ("../config.php");

$query = "SELECT Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo1 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
$resultado = mysql_query($query, $db);

$res=array();
$aux= mysql_fetch_row($resultado);
while($aux){
	array_push($res,$aux);
	$aux= mysql_fetch_row($resultado); 
}

$query = "SELECT Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo2 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
$resultado = mysql_query($query, $db);
$aux= mysql_fetch_row($resultado);
while($aux){
	array_push($res,$aux);
	$aux= mysql_fetch_row($resultado); 
}
//for($i=0;$i<count($res);$i++){
 echo json_encode($res);
//}
?>