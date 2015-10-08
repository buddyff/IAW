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
    $query="SELECT * FROM invitaciones WHERE id_invitado={$_SESSION['user_id']} AND (estado = 'no_vista' OR estado = 'nueva')";
    if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_row($resultado)){
            $cantidad++;
        }
    }
    echo $cantidad;
}

function mostrar_invitaciones(){
    
    $db = $GLOBALS['db'];
    $res = array();
    //Verifico si existe el registro turno-jugador
    $query = "SELECT j.Nombre AS nombre_jugador, j.Apellido AS apellido_jugador, c.nombre AS nombre_cancha, t.fecha AS dia, t.horario AS hora, i.id AS id_invitacion FROM invitaciones i JOIN turnos t ON (i.id_turno = t.id) JOIN canchas c ON (c.id = t.id_cancha) JOIN jugadores j ON (j.id = i.id_invitador) WHERE i.id_invitado = '{$_SESSION['user_id']}' AND i.estado = 'nueva'";
    if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
            array_push($res,$fila);
        }
    }
    echo json_encode($res);
}

function aceptar_invitacion(){
    $db = $GLOBALS['db'];
    $data = $GLOBALS['data'];

}
//MUESTRA LOS TURNOS DEL JUGADOR ACTUAL.
// $query = "SELECT j.Nombre, j.Apellido, c.nombre, t.fecha, t.horario FROM canchas c JOIN turnos t ON (c.id = t.id_cancha) JOIN turnos_jugadores tj ON (tj.id_turno = t.id) JOIN jugadores j ON (j.id = tj.id_jugador) WHERE j.id = '{$_SESSION['user_id']}'";
    
?>

