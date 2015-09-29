<?php
include ("../config.php");
$funcion = $_POST['funcion'];

if(function_exists($funcion)){
    call_user_func($funcion);
}

function cantidad_invitaciones(){
    
    $db = $GLOBALS['db'];
    $cantidad = 0;
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM invitaciones WHERE id_invitado={$_SESSION['user_id']} AND vista=0";
    if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_row($resultado))
            $cantidad++;
    }
    echo $cantidad;
}



?>