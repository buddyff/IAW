angular 

.module("app",['ngRoute'])

.controller("loginCtrl",['$http', login])

.controller("registroCtrl",['$http', sign_up])
	
.controller("cuentaCtrl", ['$http',cuentaCtrl])

.controller("canchaCtrl", ['$http',canchaCtrl])

.controller("amigosCtrl", ['$http',amigosCtrl])

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
            .when("/amigos", {
                controller: "amigosCtrl",
                controllerAs: "ctrl",
                templateUrl: "injections/amigos.php"
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
          .then(function(res){
              	location.href="#/";
          },function(res){
              	alert ("Error");
            });         
    }; 
}	

function cuentaCtrl($http){
	var scope=this;
	//scope.turnos=[{a:1},{a:2},{a:3}];
	
	$http.post("ajax/get_turnos.php")
	.success(function(response){
		scope.turnos= response;	
	});		
}

function canchaCtrl($http){
	var scope=this;
	$http.get("ajax/ver_canchas.php").
	  then(function(response) {
	    // this callback will be called asynchronously
	    // when the response is available
	    scope.canchas = response.data;
	  }, function(response) {
	    // called asynchronously if an error occurs
	    // or server returns response with an error status.
	    scope.canchas = "no anda";
	  }); 
}

function amigosCtrl($http){
	var scope = this;
	
	$http.get("ajax/get_amigos.php").
		then(function(response){
			scope.amigos = response.data;
		}, function(response){
			scope.amigos = "No tenes amigos papá!";
		});	
}


