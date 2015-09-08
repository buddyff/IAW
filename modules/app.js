angular 

.module("app",['ngRoute'])

.controller("loginCtrl",['$http', login])

.controller("registroCtrl",['$http', sign_up])
	
.controller("cuentaCtrl", ['$http',cuentaCtrl])

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
            });
   });
   
function login($http){
	var scope=this;
	
	//scope.datos={};
	
	scope.enviar = function(){
          $http.post("ajax/login_jugador.php", scope.datos)
          .success(function(res){
              if(res)
              	location.href="#/mi_cuenta";
              else
              	alert ("Error");
            });         
    }; 	
}

function sign_up($http){
	var scope=this;
	
	scope.sign_up = function(){
          $http.post("ajax/sign_up.php", scope.datos)
          .success(function(res){
              if(res)
              	location.href="#/mi_cuenta";
              else
              	alert ("Error");
            });         
    }; 
}

function logout($http){
	var scope=this;
	
	scope.logout = function(){
          $http.post("ajax/logout.php", scope.datos)
          .success(function(res){
              if(res)
              	location.href="#/";
              else
              	alert ("Error");
            });         
    }; 
}	

function cuentaCtrl($http){
	var scope=this;
	//scope.turnos=[{a:1},{a:2},{a:3}];
	
	
	
	//Recupero los turnos en estado Registrando y seteo variables para poder navegar entre turno y turno
	$http.post("ajax/get_turnos.php")
	.success(function(response){
		scope.turno_actual=0;
		scope.cant_turnos = response.length;
		scope.turnos= response;	
	});
	
	scope.siguiente_turno=function(){
		if (scope.turno_actual==scope.cant_turnos-1)
			scope.turno_actual=0;
		else
			scope.turno_actual=scope.turno_actual+1;
	};
	
	scope.anterior_turno=function(){
		if (scope.turno_actual==0)
			scope.turno_actual=scope.cant_turnos-1;
		else
			scope.turno_actual=scope.turno_actual-1;
	};
	
	scope.registrar=function (id_turno){
		console.log("El id del turno es".concat(id_turno));
		//$http.post("ajax/anotarse_turno.php")
		
	};
}



