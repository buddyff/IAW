<?php
include ("../config.php");

$query = "SELECT * FROM turno";
$resultado = mysql_query($query, $db);

$res=array();
$aux= mysql_fetch_row($resultado);
while($aux){
array_push($res,json_encode($aux));
$aux= mysql_fetch_row($resultado); 
}
for($i=0;$i<count($res);$i++){
    echo $res[$i];
}
?>