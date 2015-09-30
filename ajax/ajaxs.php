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
    if($resultado = mysqli_query($db,$query)){
    	$resultado=  mysqli_fetch_assoc($resultado);
		$_SESSION["user_name"]= $resultado['Nombre'];
        $_SESSION["user_id"]= $resultado['Id'];     
        if($resultado['Id']!=null)
            echo $resultado['Nombre'];
        else
            echo false;
            
    }
    else
        echo false;
}


function login_cancha(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $query = "SELECT * FROM canchas WHERE email='{$data->email}' and pass='{$data->pass}'";
    if($resultado = mysqli_query($db,$query)){
        $resultado=  mysqli_fetch_assoc($resultado);
        $_SESSION["user_name"]= $resultado['nombre'];
        $_SESSION["user_id"]= $resultado['id'];     
        if($resultado['id']!=null)
            echo TRUE;
        else
            echo false;
            
    }
    else
        echo false;
}

function logout(){
    $_SESSION['user_name']=null;
}

function anotarse_turno(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Aumento en uno la cantidad de inscriptos en el turno
    $query = "UPDATE turnos SET inscriptos=inscriptos+1 WHERE id={$data->turno}";
    $resultado = mysqli_query($db,$query);
    
    //Registro al jugador en el turno
    $query="INSERT INTO turnos_jugadores (id_turno,id_jugador,resultado) VALUES ({$data->turno},{$_SESSION['user_id']},'null')";
    $resultado = mysqli_query($db,$query);

    $query="SELECT id FROM invitaciones WHERE id_invitado = {$_SESSION['user_id']}";
    $resultado = mysqli_query($db,$query);
    if($fila = mysqli_fetch_row($resultado)){
        $query = "DELETE FROM invitaciones WHERE id_invitado = {$_SESSION['user_id']}";
        mysqli_query($db,$query);
    }
}

function get_turnos(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Selecciono los turnos que están en estado Registrando y los ordeno por proximidad de fecha;
    $query = "SELECT t.id AS id_turno,t.fecha AS fecha,t.horario AS horario,t.inscriptos AS inscriptos,c.nombre AS nombre
    		 FROM turnos t JOIN canchas c WHERE estado='Registrando' ORDER BY fecha ASC";
   if($resultado = mysqli_query($db,$query)){
    	$res = array();
		while($fila = mysqli_fetch_assoc($resultado)){
    		array_push($res,$fila);
    	}
    }
    echo json_encode($res);
}

function is_registered(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM turnos_jugadores WHERE id_turno={$data->id_turno} AND id_jugador={$_SESSION['user_id']}";
    if($resultado = mysqli_query($db,$query)){
    	if($fila = mysqli_fetch_row($resultado))
			echo 1;
		else 
			echo 0;
    }
}

function is_user_registered(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res = array();
    array_push($res,$data->id_amigo);
	array_push($res,$data->id_turno);
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM turnos_jugadores WHERE id_turno={$data->id_turno} AND id_jugador={$data->id_amigo}";
    if($resultado = mysqli_query($db,$query)){
    	if($fila = mysqli_fetch_row($resultado))
			array_push($res,true);
		else 
			array_push($res,false);
    }
    echo json_encode($res);
}

function esta_invitado(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res = array();
    array_push($res,$data->id_amigo);
    array_push($res,$data->id_turno);
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM invitaciones WHERE id_turno={$data->id_turno} AND id_invitado={$data->id_amigo}";
    if($resultado = mysqli_query($db,$query)){
        if($fila = mysqli_fetch_row($resultado))
            array_push($res,true);
        else 
            array_push($res,false);
    }
    echo json_encode($res);
}

function cantidad_invitaciones(){
    
    $data = $GLOBALS['data'];
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

function salir_turno(){
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Decremento en uno la cantidad de inscriptos en el turno
    $query = "UPDATE turnos SET inscriptos=inscriptos-1 WHERE id={$data->turno}";
    if($resultado = mysqli_query($db,$query)){
    }
    
    //Saco el registro del jugador en el turno
    $query="DELETE FROM turnos_jugadores WHERE id_turno={$data->turno} AND id_jugador={$_SESSION['user_id']} ";
    if($resultado = mysqli_query($db,$query)){
    }
    
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
    $db = $GLOBALS['db'];    	
	$res=array();
    
    $query = "SELECT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo1 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
    if($resultado = mysqli_query($db,$query)){
    	while($fila = mysqli_fetch_assoc($resultado)){
    		array_push($res,$fila);
    	}
    }
	
	$query = "SELECT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a ON (a.id_amigo2 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}')";
    if($resultado = mysqli_query($db,$query)){
    	while($fila = mysqli_fetch_assoc($resultado)){
    		array_push($res,$fila);
    	}
    }
     echo json_encode($res);
}

function ver_canchas(){
              
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    $query = "SELECT * FROM canchas ORDER BY nombre ASC";
    
    if($resultado = mysqli_query($db,$query)){
    	$res = array();
		while($fila = mysqli_fetch_assoc($resultado)){
    		array_push($res,$fila);
    	}
    }
    echo json_encode($res); 
}

function get_historial(){ 
    
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res = array();
    
    //Selecciono los turnos que el jugador se anoto y que se encuentran en estado "finalizado";
    $query="SELECT c.nombre,t.fecha,t.horario,tj.resultado FROM turnos_jugadores tj JOIN turnos t ON (tj.id_turno=t.id) JOIN canchas c ON(c.id=t.id_cancha)
            WHERE tj.id_jugador={$_SESSION['user_id']} AND t.estado='Finalizado'";
     if($resultado = mysqli_query($db,$query)){
		while($fila = mysqli_fetch_assoc($resultado)){
          array_push($res,$fila);
    	}
    }
    
    echo json_encode($res);
     
}

function get_estadisticas(){
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $ganados=0;
    $empatados=0;
    $perdidos=0;
    //Selecciono los turnos que el jugador se anoto y que se encuentran en estado "finalizado";
    $query="SELECT c.nombre,t.fecha,t.horario,tj.resultado FROM turnos_jugadores tj JOIN turnos t ON (tj.id_turno=t.id) JOIN canchas c ON(c.id=t.id_cancha)
            WHERE tj.id_jugador={$_SESSION['user_id']} AND t.estado='Finalizado'";
    if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
            switch($fila['resultado']){
                case 'Gano':{
                    $ganados++;break;
                }
                case 'Empato': {
                    $empatados++;break;
                }
                case'Perdio' :{
                    $perdidos++;break;
                }
            }
         }
    }
    $res=array();
    array_push($res,array('Ganados'=>$ganados,'Empatados'=>$empatados,'Perdidos'=>$perdidos));
    echo json_encode($res); 
}

function invitar(){	
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
	
	$query = "INSERT INTO invitaciones (id_invitador,id_invitado,id_turno) VALUES ('{$_SESSION['user_id']}','{$data->id_invitado}','{$data->id_turno}')";
    
    if($resultado = mysqli_query($db,$query)){
    	echo 1;
	}
	else
		echo 0;
}

?>