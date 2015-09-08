<?php
include ("../config.php");

$query = "SELECT id_amigo1 FROM amigos WHERE id_amigo2 = " + $_SESSION['user_id'] + "ORDER ASC";
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