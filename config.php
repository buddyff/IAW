<?php


/***********************************/
/*        CONEXION A LA DB         */
/***********************************/

$server = "localhost";
$user = "root";
//$pass = "proyecto123";
$db = "proyecto_iaw";
$conection = mysql_connect($server, $user);
mysql_select_db($db,$conection); 








?>