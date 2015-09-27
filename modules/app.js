angular 

.module("app",['ngRoute'])

.controller("logoutCtrl",['$http',logoutCtrl])

.controller("loginCtrl",['$http', login])

.controller("registroCtrl",['$http', sign_up])
	
.controller("cuentaCtrl", ['$http',cuentaCtrl])

.controller("canchaCtrl", ['$http',canchaCtrl])

.controller("amigosCtrl", ['$http',amigosCtrl])

.controller("historialCtrl", ['$http',historialCtrl])

.config(function($routeProvider){
        $routeProvider
            .when("/", {
                controller: "loginCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/index.html"
            })
            .when("/mi_cuenta", {
                controller: "cuentaCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/mi_cuenta.php"
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
	
	scope.enviar = function(){
		  scope.datos.funcion="login_jugador";
          $http.post("ajax/ajaxs.php", scope.datos)
          .success(function(res){
              if(res){
              	location.href="#/mi_cuenta";
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

function cuentaCtrl($http){
	var scope=this;
	scope.datos={};
	scope.datos.funcion="get_turnos";
	//scope.turnos=[{a:1},{a:2},{a:3}];
		
	//Recupero los turnos en estado Registrando y seteo variables para poder navegar entre turno y turno
	$http.post("ajax/ajaxs.php",scope.datos)
	.success(function(response){
		
		scope.turno_actual=0;
		scope.cant_turnos = response.length;
		scope.turnos= response;
		
		//Verificacion disponibilidad del turno
		if (scope.turnos[scope.turno_actual]["inscriptos"]<10)
			scope.disponibilidad ='disponible';
		else
			scope.disponibilidad = 'lleno';	
		
		//Control si el jugador esta o no registrado al turno
		scope.is_registered();

			
	});
	
	
	//Funcion para consultar si el jugador esta registrado en el turno
	scope.is_registered=function(){
		scope.datos={};
		scope.datos.funcion="is_registered";
		scope.datos.id_turno=scope.turnos[scope.turno_actual]["id_turno"];
		
		$http.post("ajax/ajaxs.php",scope.datos)
		.success(function(response){
			if(response==1){
				scope.disponibilidad='registrado';
				console.log("entre aca")	;
			}
			else
		 		scope.disponibilidad='disponible';
		});
	};		
	
	
	//Funcion para visualizar el siguiente turno
	scope.siguiente_turno=function(){
		
		if (scope.turno_actual==scope.cant_turnos-1)
			scope.turno_actual=0;
		else
			scope.turno_actual=scope.turno_actual+1;
		
		//Verificacion de disponibilidad del turno
		if (scope.turnos[scope.turno_actual]["inscriptos"]<10)
			scope.disponibilidad ='disponible';
		else
			scope.disponibilidad = 'lleno';
			
		//Control si el jugador esta o no registrado al turno
		scope.is_registered();
	};
	
	
	//Funcion para visualizar el turno anterior
	scope.anterior_turno=function(){
		if (scope.turno_actual==0)
			scope.turno_actual=scope.cant_turnos-1;
		else
			scope.turno_actual=scope.turno_actual-1;
		
		//Verificacion de disponibilidad del turno	
		if (scope.turnos[scope.turno_actual]["inscriptos"]<10)
			scope.disponibilidad ='disponible';
		else
			scope.disponibilidad = 'lleno';
			
		//Control si el jugador esta o no registrado al turno
		scope.is_registered();
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
			if (response)
				//Verificacion de disponibilidad del turno	
				if (scope.turnos[scope.turno_actual]["inscriptos"]<10)
					scope.disponibilidad ='disponible';
				else
					scope.disponibilidad = 'lleno';
				
				//Control si el jugador esta o no registrado al turno
				scope.is_registered();
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
			//Verificacion de disponibilidad del turno	
			if (scope.turnos[scope.turno_actual]["inscriptos"]<10)
				scope.disponibilidad ='disponible';
			else
				scope.disponibilidad = 'lleno';
			
			//Control si el jugador esta o no registrado al turno
			scope.is_registered();
		});
	};
	
	scope.invitar_amigos=function(){
		scope.datos = {};
		scope.datos.funcion = "get_amigos";
		$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			scope.amigos = response;
			scope.registrado = new Array();
			for(i=0;i<scope.amigos.length;i++){
				scope.data = {};
				scope.data.funcion = "is_user_registered";
				scope.data.id_amigo = scope.amigos[i]["Id"];
				scope.data.id_turno = scope.turnos[scope.turno_actual]["id_turno"];
				$http.post("ajax/ajaxs.php",scope.data)				
				.success(function(response){
					if(response==1){
						scope.registrado[scope.data.id_amigo]='si';
					}
					else{
						if(scope.registrado[scope.data.id_amigo]!='invitado'){
				 			scope.registrado[scope.data.id_amigo]='no';
				 			console.log("¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡cambie!!!!!!!!!!!!!!!!!!!!!!!!");
				 		}
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
		console.log(id_invitado);
		console.log(scope.turnos[scope.turno_actual]["id"]);
		scope.datos.funcion = "invitar";
		console.log("Por hacer post invitar");
		$http.post("ajax/ajaxs.php",scope.datos).
		success(function(response){
			scope.registrado[id_invitado] = 'invitado';
		});
	};
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



