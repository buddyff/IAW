<?php


/***********************************/
/*        CONEXION A LA DB         */
/***********************************/

$server = "localhost";
$user = "root";
//$pass = "proyecto123";
$nombre_db = "proyecto_iaw";
if (!$db = mysql_connect($server, $user)){
    echo "ERROR !";
    exit;
}

if(!mysql_select_db($nombre_db,$db)){
    echo "ERROR 2";
    exit;
}








?>