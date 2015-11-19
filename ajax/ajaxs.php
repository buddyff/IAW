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
    
    //Si se lleno el turno armo los equipos
    $query="SELECT inscriptos FROM turnos WHERE id={$data->turno}";
    $resultado = mysqli_query($db,$query);
    $fila = mysqli_fetch_assoc($resultado);
    if ($fila['inscriptos']==10){
        $query="SELECT j.id,puntaje 
                FROM jugadores j JOIN turnos_jugadores tj ON (j.id=tj.id_jugador) 
                WHERE tj.id_turno={$data->turno} ORDER BY puntaje desc";
        $resultado = mysqli_query($db,$query);
        for($i=0;$i<5;$i++){
            
            $id_jugador_1=mysqli_fetch_assoc($resultado);
            $id_jugador_1=$id_jugador_1['id'];
            
            $id_jugador_2=mysqli_fetch_assoc($resultado);
            $id_jugador_2=$id_jugador_2['id'];
            
            $query="UPDATE turnos_jugadores SET equipo=0 WHERE id_jugador={$id_jugador_1}";
            mysqli_query($db,$query);
            $query="UPDATE turnos_jugadores SET equipo=1 WHERE id_jugador={$id_jugador_2}";
            mysqli_query($db,$query);
        }
        
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

function status_turno(){
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res=array();
    
    //Verifico si existe el registro turno-jugador
    $query="SELECT * FROM turnos_jugadores WHERE id_turno={$data->id_turno} AND id_jugador={$_SESSION['user_id']}";
    if($resultado = mysqli_query($db,$query)){
        if($fila = mysqli_fetch_row($resultado))
            array_push($res,1); //registrado
        else
            array_push($res,0); //no registrado
        
        $query="SELECT inscriptos FROM turnos WHERE id={$data->id_turno}";
        $resultado=mysqli_query($db,$query);
        $resultado=mysqli_fetch_assoc($resultado);
        if($resultado['inscriptos']==10)
           array_push($res,1); //lleno 
        else
            array_push($res,0); //no lleno
        
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
    
    $resultado = mysqli_query($db,$query);
    
    
    if($resultado){
        $_SESSION["user_name"]= $nombre;
        //$_SESSION["user_id"]= $resultado['Id'];
        echo 1;
    }
    else
        echo 0;
}

function get_amigos(){
    $data = $GLOBALS['data'];    
    $db = $GLOBALS['db'];    	
	$res=array();
	$incluir=null;
    if(isset($data->incluir))
         $incluir = $data->incluir;
    
        
    
    if($incluir!=null){
        $query = "SELECT DISTINCT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email,Pj,Pg,Pe,Pp FROM jugadores j JOIN amigos a 
        ON (a.id_amigo1 = j.id) WHERE (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}') ORDER BY j.puntaje DESC";
        if($resultado = mysqli_query($db,$query)){
            while($fila = mysqli_fetch_assoc($resultado)){
                array_push($res,$fila);
            }
        }
        
        $query = "SELECT DISTINCT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email,Pj,Pg,Pe,Pp FROM jugadores j JOIN amigos a 
        ON (a.id_amigo2 = j.id) WHERE (a.id_amigo1 = '{$_SESSION['user_id']}' OR a.id_amigo2 = '{$_SESSION['user_id']}') ORDER BY puntaje DESC";
        if($resultado = mysqli_query($db,$query)){
            while($fila = mysqli_fetch_assoc($resultado)){
                array_push($res,$fila);
            }
        }
    }
    
    else{
        $query = "SELECT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a 
        ON (a.id_amigo1 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR 
            a.id_amigo2 = '{$_SESSION['user_id']}') ORDER BY puntaje DESC";
        if($resultado = mysqli_query($db,$query)){
        	while($fila = mysqli_fetch_assoc($resultado)){
        		array_push($res,$fila);
        	}
        }
    	
    	$query = "SELECT j.Id,Nombre, Apellido, Puntaje, Direccion, Telefono, Edad, Email FROM jugadores j JOIN amigos a 
        ON (a.id_amigo2 = j.id) WHERE j.Nombre != '{$_SESSION['user_name']}' AND (a.id_amigo1 = '{$_SESSION['user_id']}' OR 
            a.id_amigo2 = '{$_SESSION['user_id']}') ORDER BY puntaje DESC";
        if($resultado = mysqli_query($db,$query)){
        	while($fila = mysqli_fetch_assoc($resultado)){
        		array_push($res,$fila);
        	}
        }
    }
     echo json_encode($res);
}

function get_jugadores(){
    $db = $GLOBALS['db'];     
    $data = $GLOBALS['data'];

    $res=array();
    
    $query = "SELECT Id, Nombre, Apellido, Puntaje, Telefono, Edad, Email FROM jugadores WHERE Id != '{$_SESSION['user_id']}'";
    if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
            $eh_amigo = false;
            for ($i=0; $i < sizeof($data->amigos); $i++) {
                $mis_amigos = ((array)$data->amigos[$i]);
                //echo $mis_amigos['Id'];
                if($mis_amigos['Id']==$fila['Id']){
                    $eh_amigo = true;
                    break;
                }
            }
            if(!$eh_amigo)
                array_push($res,$fila);
        }
    }
    echo json_encode($res);
}

function agregarAmigo(){
    $db = $GLOBALS['db'];
    $data = $GLOBALS['data'];

    $query = "INSERT INTO amigos (id_amigo1,id_amigo2) VALUES ('{$_SESSION['user_id']}','{$data->id_jugador}')";
    if($resultado = mysqli_query($db,$query)){
        echo "agregado!";
    }
}

function ver_canchas(){
              
    //$data = $GLOBALS['data'];
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
    
    //$data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res = array();
    
    //Selecciono los turnos que el jugador se anoto y que se encuentran en estado "finalizado";
    $query="SELECT c.nombre,t.fecha,t.horario,tj.resultado FROM turnos_jugadores tj JOIN turnos t ON (tj.id_turno=t.id) JOIN canchas c ON(c.id=t.id_cancha)
            WHERE tj.id_jugador={$_SESSION['user_id']} AND t.estado='Cerrado'";
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
            WHERE tj.id_jugador={$_SESSION['user_id']} AND t.estado='Cerrado'";
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


//Devuelve el turno que se esta jugando actualmente para la cancha loggeada
function get_turno_actual(){
    
    $db = $GLOBALS['db']; 
    $res = array();
    $query="SELECT j.nombre,t.horario FROM turnos t JOIN turnos_jugadores tj ON (t.id=tj.id_turno) JOIN jugadores j ON (j.id=tj.id_jugador)
            WHERE t.id_cancha={$_SESSION['user_id']} AND t.estado='Jugando' AND fecha=CURRENT_DATE AND TIMEDIFF(CURRENT_TIME,t.horario)<='01:00:00' 
            ORDER BY equipo DESC";
     if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
          array_push($res,$fila);
        }
        echo json_encode($res);
     }    
}

//Devuelve todo los turnos que encuentran en estado Finalizado
function get_turnos_cargar(){
    
    $db = $GLOBALS['db'];
    $res = array();
    $query="SELECT t.id FROM turnos t  WHERE  t.estado='Finalizado' ORDER BY fecha ASC";
   if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
          array_push($res,$fila);
        }
        echo json_encode($res);
     }         
}    


function get_info_turno (){
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    $res = array();
    $query="SELECT j.id,j.nombre,t.horario,t.fecha FROM turnos t JOIN turnos_jugadores tj ON (t.id=tj.id_turno) JOIN jugadores j ON (j.id=tj.id_jugador)
            WHERE  t.id={$data->turno} ORDER BY equipo ASC";
     if($resultado = mysqli_query($db,$query)){
        while($fila = mysqli_fetch_assoc($resultado)){
          array_push($res,$fila);
        }
        echo json_encode($res);
     }
}

function cargar_resultado(){
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Obtengo los datos
    $id_turno = $data->id_turno;
    $res_0 = $data->resultado_0;
    $res_1=$data->resultado_1;
    $gano_0=false;
    $gano_1=false;
    $empate=false;
   
    //Determino que equipo gano
    if ($res_0 > $res_1) $gano_0=true;
    else
        if ($res_0 < $res_1) 
            $gano_1=true;
        else 
            $empate=true;
    
    //Actualizo la tabla turnos_jugadores 
    if($gano_0){
        $query = "UPDATE turnos_jugadores SET resultado='Gano' WHERE id_turno={$id_turno} AND equipo=0";
        mysqli_query($db,$query);
        $query = "UPDATE turnos_jugadores SET resultado='Perdio' WHERE id_turno={$id_turno} AND equipo=1";
        mysqli_query($db,$query);
    }
    else
        if($gano_1){
             $query = "UPDATE turnos_jugadores SET resultado='Perdio' WHERE id_turno={$id_turno} AND equipo=0";
            mysqli_query($db,$query);
            $query = "UPDATE turnos_jugadores SET resultado='Gano' WHERE id_turno={$id_turno} AND equipo=1";
            mysqli_query($db,$query);
        }
        else {
            $query = "UPDATE turnos_jugadores SET resultado='Empato' WHERE id_turno={$id_turno}";
            mysqli_query($db,$query);
            
        }
     
     //Actualizo los puntajes de los jugadores
     if($gano_0){
         //Actualizo los puntos del equipo ganador
         $query="SELECT id_jugador FROM turnos_jugadores WHERE id_turno={$id_turno} AND equipo=0";
         $resultado=mysqli_query($db,$query);
         while($fila = mysqli_fetch_assoc($resultado)){
           $id_jugador= $fila['id_jugador'];
           $query="UPDATE jugadores SET Puntaje=Puntaje+3,Pj=Pj+1,Pg=Pg+1 WHERE id={$id_jugador}";
           mysqli_query($db,$query);
         }      
         //Actualizo los puntos del equipo perdedor
         $query="SELECT id_jugador FROM turnos_jugadores WHERE id_turno={$id_turno} AND equipo=1";
         $resultado=mysqli_query($db,$query);
         while($fila = mysqli_fetch_assoc($resultado)){
           $id_jugador= $fila['id_jugador'];
           $query="UPDATE jugadores SET Pj=Pj+1,Pp=Pp+1 WHERE id={$id_jugador}";
           mysqli_query($db,$query);
        }
     }
     
     else
         if($gano_1){
             //Actualizo los puntos del equipo ganador
             $query="SELECT id_jugador FROM turnos_jugadores WHERE id_turno={$id_turno} AND equipo=1";
             $resultado=mysqli_query($db,$query);
             while($fila = mysqli_fetch_assoc($resultado)){
               $id_jugador= $fila['id_jugador'];
               $query="UPDATE jugadores SET Puntaje=Puntaje+3,Pj=Pj+1,Pg=Pg+1 WHERE id={$id_jugador}";
               mysqli_query($db,$query);
            }
            
            //Actualizo los puntos del equipo perdedor
             $query="SELECT id_jugador FROM turnos_jugadores WHERE id_turno={$id_turno} AND equipo=0";
             $resultado=mysqli_query($db,$query);
             while($fila = mysqli_fetch_assoc($resultado)){
               $id_jugador= $fila['id_jugador'];
               $query="UPDATE jugadores SET Pj=Pj+1,Pp=Pp+1 WHERE id={$id_jugador}";
               mysqli_query($db,$query);
            }
         }
          else{
             if ($empate){
                 $query="SELECT id_jugador FROM turnos_jugadores WHERE id_turno={$id_turno}";
                 $resultado=mysqli_query($db,$query);
                 while($fila = mysqli_fetch_assoc($resultado)){
                   $id_jugador= $fila['id_jugador'];
                   $query="UPDATE jugadores SET Puntaje=Puntaje+1,Pj=Pj+1,Pe=Pe+1 WHERE id={$id_jugador}";
                   mysqli_query($db,$query);
                }
             }
        }
        
       //Actualizo el estado del turno a CERRADO
       $query="UPDATE turnos SET estado='Cerrado' WHERE id={$id_turno}";
       mysqli_query($db,$query);
}      


function crear_turno(){
    $data = $GLOBALS['data'];
    $db = $GLOBALS['db'];
    
    //Cambio el formato de la fecha para que sea compatible con el tipo date de mysql
    $fecha = date('Y-m-d',strtotime($data->fecha));
    
    $query = "INSERT INTO turnos (id_cancha,resultado,fecha,horario,estado,inscriptos)
                   VALUES ({$_SESSION['user_id']},null,'{$fecha}','{$data->hora}','Registrando',0)";
    mysqli_query($db,$query);  
    echo 1;            
}    
    


?>