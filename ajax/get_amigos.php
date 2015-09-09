<?php
include ("../config.php");

$query = "SELECT Nombre, Apellido FROM jugadores INNER JOIN amigos WHERE (amigos.id_amigo1 = jugadores.id OR amigos.id_amigo2 = jugadores.id) AND Nombre != '{$_SESSION['user_name']}'";
$resultado = mysql_query($query, $db);

$res=array();
$aux= mysql_fetch_row($resultado);
while($aux){
array_push($res,$aux);
$aux= mysql_fetch_row($resultado); 
}
//for($i=0;$i<count($res);$i++){
 echo json_encode($res);
//}
?>