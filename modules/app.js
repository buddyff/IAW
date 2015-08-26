angular 

.module("app",['ngRoute'])

.controller("loginCtrl",['$http', login])

.controller("registroCtrl",['$http', sign_up])
	
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
                templateUrl: "injections/mi_cuenta.html"
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
              	alert ("Todo piola");
              else
              	alert ("Error");
            });
         
    }; 
	


}

	

