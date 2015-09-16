<?php
include ("../config.php");

//Obtencion de los datos
$data = json_decode(file_get_contents("php://input"));

//Obtencion de la funcion a ejecutar
$funcion = $data->funcion;

//Si la funcion existe la ejecuta
if(function_exists($funcion)){
    call_user_func($funcion);
}


function login_jugador(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $query = "SELECT * FROM jugadores WHERE Email='{$data->email}' and Pass='{$data->pass}'";
    $resultado = mysql_query($query, $db);
    $resultado=  mysql_fetch_assoc($resultado);
    
    if($resultado){
        $_SESSION["user_name"]= $resultado['Nombre'];
        $_SESSION["user_id"]= $resultado['Id'];     
        echo 1;
    }
    else
        echo 0;
}

function anotarse_turno(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Aumento en uno la cantidad de inscriptos en el turno
    $query = "UPDATE turnos SET inscriptos=inscriptos+1 WHERE id={$data->turno}";
    $resultado = mysql_query($query, $db);
    
    //Registro al jugador en el turno
    $query="INSERT INTO turnos_jugadores (id_turno,id_jugador) VALUES ({$data->turno},{$_SESSION['user_id']})";
    $resultado = mysql_query($query, $db);
}

function get_turnos(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Selecciono los turnos que están en estado Registrando y los ordeno por proximidad de fecha;
    $query = "SELECT * FROM turnos t JOIN cancha WHERE estado='Registrando' ORDER BY fecha ASC";
    $resultado = mysql_query($query, $db);
    
    $res=array();
    $aux= mysql_fetch_row($resultado);
    while($aux){
    array_push($res,$aux);
    $aux= mysql_fetch_row($resultado); 
    }
    echo json_encode($res);
}

function is_registered(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM turnos_jugadores WHERE id_turno={$data->id_turno} AND id_jugador={$_SESSION['user_id']}";
    $resultado = mysql_query($query, $db);
    $resultado= mysql_fetch_row($resultado);
    $resultado=json_encode($resultado);
    
    if($resultado=='false')
        echo 0;
    else 
        echo 1;
}

function salir_turno(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Decremento en uno la cantidad de inscriptos en el turno
    $query = "UPDATE turnos SET inscriptos=inscriptos-1 WHERE id={$data->turno}";
    $resultado = mysql_query($query, $db);
    
    //Saco el registro del jugador en el turno
    $query="DELETE FROM turnos_jugadores WHERE id_turno={$data->turno} AND id_jugador={$_SESSION['user_id']} ";
    $resultado = mysql_query($query, $db);
    
}

function sign_up(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $nombre = $data->nombre;
    $apellido = $data->apellido;
    $edad = $data->edad;
    $direccion= $data->direccion;
    $telefono = $data->telefono;
    $email = $data->email;
    $password = $data->password;
    
    $query = "INSERT INTO jugadores (Nombre,Apellido,Telefono,Direccion,Edad,Email,Pass) VALUES ('{$nombre}','{$apellido}','{$telefono}','{$direccion}','{$edad}','{$email}','{$password}')";
    
    $resultado = mysql_query($query, $db);
    
    
    if($resultado){
        $_SESSION["user_name"]= $resultado['Nombre'];
        $_SESSION["user_id"]= $resultado['Id'];
        echo 1;
    }
    else
        echo 0;
}

function get_amigos(){

    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $query = "SELECT Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo1 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
    $resultado = mysql_query($query, $db);
    
    $res=array();
    $aux= mysql_fetch_row($resultado);
    while($aux){
        array_push($res,$aux);
        $aux= mysql_fetch_row($resultado); 
    }
    
    $query = "SELECT Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo2 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
    $resultado = mysql_query($query, $db);
    $aux= mysql_fetch_row($resultado);
    while($aux){
        array_push($res,$aux);
        $aux= mysql_fetch_row($resultado); 
    }
    //for($i=0;$i<count($res);$i++){
     echo json_encode($res);
}

function ver_canchas(){
              
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $query = "SELECT * FROM canchas ORDER BY nombre ASC";
    
    $resultado = mysql_query($query, $db);
    $res = array();
    $aux = mysql_fetch_row($resultado);
    while($aux){
        array_push($res,$aux);
        $aux = mysql_fetch_row($resultado);
    }
    echo json_encode($res);          
        
        
    
}

?>