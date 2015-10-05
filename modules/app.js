angular 

.module("app",['ngRoute'])

.controller("logoutCtrl",['$http',logoutCtrl])

.controller("loginCtrl",['$http', login])

.controller("registroCtrl",['$http', sign_up])
	
.controller("cuentaJugadorCtrl", ['$http',cuentaJugadorCtrl])

.controller("cuentaCanchaCtrl", ['$http',cuentaCanchaCtrl])

.controller("canchaCtrl", ['$http',canchaCtrl])

.controller("amigosCtrl", ['$http',amigosCtrl])

.controller("historialCtrl", ['$http',historialCtrl])

.config(function($routeProvider){
        $routeProvider
            .when("/", {
                controller: "loginCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/index.php"
            })
            .when("/inicio_jugador", {
                controller: "cuentaJugadorCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/inicio_jugador.php"
            })
            .when("/inicio_cancha", {
                controller: "cuentaCanchaCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/inicio_cancha.php"
            })
            .when("/registro", {
                controller: "registroCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/registro.html"
            })
            .when("/cancha", {
                controller: "canchaCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/cancha.php"
            })
            .when("/historial", {
                controller: "historialCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/historial.php"
            })
            .when("/amigos", {
                controller: "amigosCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/amigos.php"
            });
   });
   
function login($http){
	var scope=this;
	scope.datos={};
	scope.nombre;
   
	scope.enviar_jugador = function(){
	  
	  scope.datos.funcion="login_jugador";
      $http.post("ajax/ajaxs.php", scope.datos)
      .success(function(res){
          console.log(scope.nombre);
          if(res){
          	location.href="#/inicio_jugador";
          	
          }
          else{
          	$("#login_incorrecto").modal('toggle');
          }
        });   
         
    };
    
    
    scope.enviar_cancha=function(){
    	
    	scope.datos.funcion="login_cancha";
    	$http.post("ajax/ajaxs.php", scope.datos)
    	.success(function(res){
    		if(res){
					location.href="#/inicio_cancha";
			}
    		else{
    			$("#login_incorrecto").modal('toggle');
    		}
    	});
    };
    
    
}

function sign_up($http){
	var scope=this;
	scope.datos={};
	scope.datos.funcion="sign_up";
	scope.sign_up = function(){
          $http.post("ajax/ajaxs.php", scope.datos)
          .success(function(res){
              if(res)
              	location.href="#/mi_cuenta";
              else
              	alert ("Error");
            });         
    }; 
}

function logoutCtrl($http){
	var scope = this;
	scope.datos={};
	scope.datos.funcion='logout';
	scope.logout = function(){
          $http.post("ajax/ajaxs.php",scope.datos)
          .success(function(response){
              	location.href="#/";
          		});
          	};     
}
//----------------------------------------------------------------------------
//------------------Controlador cuenta de usuario-----------------------------
//----------------------------------------------------------------------------

function cuentaJugadorCtrl($http){
	var scope=this;
	scope.datos={};
	
	scope.datos.funcion="get_turnos";
	//scope.disponibilidad;
	scope.registrado = new Array();
	//scope.turnos=[{a:1},{a:2},{a:3}];
		
	//Recupero los turnos en estado Registrando y seteo variables para poder navegar entre turno y turno
	$http.post("ajax/ajaxs.php",scope.datos)
	.success(function(response){
		//console.log(scope.disponibilidad);
		scope.turno_actual=0;
		scope.cant_turnos = response.length;
		
		scope.turnos= response;
		
		for(i = 0 ; i < scope.cant_turnos ; i++){
			scope.registrado[scope.turnos[i]["id_turno"]] = new Array();
		}
		
		scope.status_turno();
		
	});
	
	//Funcion para determinar del estado del turno para el usuario
	scope.status_turno=function(){
		scope.datos={};
		scope.datos.funcion="status_turno";
		
		scope.datos.id_turno=scope.turnos[scope.turno_actual]["id_turno"];
		$http.post("ajax/ajaxs.php",scope.datos)
		.success(function(response){
			if(response==1){
				 scope.disponibilidad='registrado';
				 
			}
			else{
				 if (response==2)
					scope.disponibilidad = 'lleno';
				else
				 	scope.disponibilidad='disponible';
				 
			}
		});
		
	};		
	
	
	//Funcion para visualizar el siguiente turno
	scope.siguiente_turno=function(){
		
		if (scope.turno_actual==scope.cant_turnos-1)
			scope.turno_actual=0;
		else
			scope.turno_actual=scope.turno_actual+1;
		
		scope.status_turno();
		
		
	};
	
	
	//Funcion para visualizar el turno anterior
	scope.anterior_turno=function(){
		if (scope.turno_actual==0)
			scope.turno_actual=scope.cant_turnos-1;
		else
			scope.turno_actual=scope.turno_actual-1;
		
		scope.status_turno();
	
	};
	
	//Funcion para registrar al jugador en el turno en el que se esta parado actualmente
	scope.registrar=function (){
		
		//Definicion de datos
		scope.datos={};
		scope.datos.turno=scope.turnos[scope.turno_actual]["id_turno"];
		scope.datos.funcion = "anotarse_turno";
		
		//Hago la peticion Ajax pasansole el Id del turno al cual quiero anotarme
		$http.post("ajax/ajaxs.php",scope.datos)
		.success(function(response){
			if (response){							
				scope.status_turno();
			}
		});
	};
	
	//Funcion para desregistrar al jugador en el turno en el que se esta parado actualmente
	scope.salir=function (){
		scope.datos={};
		scope.datos.turno=scope.turnos[scope.turno_actual]["id_turno"];
		scope.datos.funcion = "salir_turno";
		//Hago la peticion Ajax pasansole el Id del turno al cual quiero anotarme
		$http.post("ajax/ajaxs.php",scope.datos)
		.success(function(response){
					scope.status_turno();
		});
	};
	
	scope.invitar_amigos=function(){
		scope.datos = {};
		scope.datos.funcion = "get_amigos";
		$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			scope.amigos = response;
			for(i=0;i<scope.amigos.length;i++){
				scope.data = {};
				scope.data.funcion = "is_user_registered";
				scope.data.id_amigo = scope.amigos[i]["Id"];
				scope.data.id_turno = scope.turnos[scope.turno_actual]["id_turno"];
				$http.post("ajax/ajaxs.php",scope.data)				
				.success(function(response){//response trae en la componente 0 id_usario, en 1 el id_turno y en 2 si el usuario esta registrado al turno.
					console.log("id usuario "+response[0]);
					console.log("id turno "+response[1]);
					console.log(scope.registrado[response[1]][response[0]]);					
					if(response[2]){
						scope.registrado[response[1]][response[0]]='si';
					}
					else{
						scope.consulta = {};
						scope.consulta.funcion = "esta_invitado";
						scope.consulta.id_amigo = response[0];
						scope.consulta.id_turno = response[1];
						$http.post("ajax/ajaxs.php",scope.consulta)				
						.success(function(response){
							if(response[2]){
								scope.registrado[response[1]][response[0]]='invitado';
								console.log(scope.registrado[response[1]][response[0]]);
							}
							else
								scope.registrado[response[1]][response[0]]='no';
						});
					}
				});
			}
		});
		$("#invitar_amigos").modal('toggle');
	};
	
	scope.invitar=function(id_invitado){
		scope.datos = {};
		scope.datos.id_invitado = id_invitado;
		scope.datos.id_turno = scope.turnos[scope.turno_actual]["id_turno"];
		scope.datos.funcion = "invitar";
		$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			scope.registrado[scope.data.id_turno][id_invitado] = 'invitado';
		});
	};
}

//----------------------------------------------------------------------------
//------------------Controlador cuenta cancha --------------------------------
//----------------------------------------------------------------------------

function cuentaCanchaCtrl($http){
	var scope=this;
	scope.datos={};
}


//----------------------------------------------------------------
//--------------------Controlador cancha-------------------------
//---------------------------------------------------------------
function canchaCtrl($http){
	var scope=this;
	scope.datos={};
	scope.datos.funcion='ver_canchas';
	$http.post("ajax/ajaxs.php",scope.datos).
	  success(function(response) {
	     if(response)
	    	scope.canchas = response;
	 	else
	 	    scope.canchas = "no anda";
	  }); 
}

function historialCtrl($http){
	var scope=this;
	scope.datos={};
	scope.datos2={};
	scope.datos.funcion="get_estadisticas";
	$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			if (response)
				scope.estadisticas=response;
			
		});
		
	
	scope.datos2.funcion="get_historial";
	
	$http.post("ajax/ajaxs.php",scope.datos2).
		success(function(response){
			if (response){
				scope.historial=response;
			}
			
		});
		
	
}

function amigosCtrl($http){
	var scope = this;
	scope.datos={};
	scope.datos.funcion="get_amigos";
	$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			if(response)
				scope.amigos = response;
			else
			scope.amigos = "No tenes amigos papá!";
		});	
}



