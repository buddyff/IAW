angular 

.module("app",[])

.controller("loginCtrl",['$http', login]);
	
function login($http){
	var scope=this;
	
	//scope.datos={};
	
	scope.enviar = function(){
          $http.post("ajax/login_jugador.php", scope.datos)
          .success(function(res){
              console.log(res);
            });
         
    }; 
	
}

	

