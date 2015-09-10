<?php
include ("../config.php");

//Obtengo los datos de la peticion
$id_turno = json_decode(file_get_contents("php://input"));
$query = "SELECT id_jugador1,id_jugador2,id_jugador3,id_jugador4,id_jugador5,id_jugador6,id_jugador7,id_jugador8,id_jugador9,id_jugador10
         FROM turno
         WHERE id={$id_turno[0]}";

//Ejecuto la consulta         
$resultado = mysql_query($query, $db);

//Obtengo la primer fila (y la unica)
$resultado=  mysql_fetch_assoc($resultado);

if($resultado){
    $stop=false;
    for ($i=1;($i<=10 && $stop=false);$i++){
        if ($resultado['id_jugador'.$i])
            $stop=true;
    }
}

echo $i;







?>