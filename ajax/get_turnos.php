<?php
include ("../config.php");

//Selecciono los turnos que están en estado Registrando y los ordeno por proximidad de fecha;
$query = "SELECT * FROM turnos t JOIN cancha WHERE estado='Registrando' ORDER BY fecha ASC";
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