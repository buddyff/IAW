<?php

include ("../config.php");

	$query = "SELECT * FROM canchas ORDER BY nombre ASC";
	
	$resultado = mysql_query($query, $db);
	$res = array();
	$aux = mysql_fetch_row($resultado);
	while($aux){
		array_push($res,$aux);
		$aux = mysql_fetch_row($resultado);
	}
	echo json_encode($res);

?>