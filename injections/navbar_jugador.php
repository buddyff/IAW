<?php include("../config.php"); ?>

   <div class="row">
        <nav class="navbar navbar-inverse" id="navbar-ppal-jugador" >
			<div class="navbar-header">
				<a class="navbar-brand" href="#/inicio_jugador">FULBITO</a>
			</div>
			<ul	class="nav navbar-nav">
				<li><a href="#/historial">HISTORIAL/ESTADISTICAS</a> </li>
				<li><a href="#/amigos">AMIGOS</a> </li>
				<li><a href="#/cancha">VER CANCHAS</a></li>
			</ul>
			<ul class="pull-right nav navbar-nav >">
				<li>
					<div class="btn-group">
					  <button type="button"  id="navbar-btn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					     <?php echo strtoupper($_SESSION['user_name']); ?><span id="notify" class="badge"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="#">Action</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a data-ng-controller="logoutCtrl as c" data-ng-click="c.logout()" >Cerrar Sesion</a></li>
					  </ul>
					</div>
					
					 </li>
					 <p id="p"></p>	
			</ul>
        </nav>
    </div>
<script>
<<<<<<< HEAD
    $(document).ready(function(){
        
        
    });
</script>
=======
	$(document).ready(function(){
			//var intervalo = setInterval('f1()',1000);
		var datos = {};
		datos.funcion = "cantidad_invitaciones";
		$.post("ajax/ajax_sin_angular.php",datos).
		success(function(response){
			$('#notify').html(response);
		});	

		datos.funcion = "mostrar_invitaciones";
		$.post("ajax/ajax_sin_angular.php",datos).
		success(function(response){
			console.log(response);
			var invitaciones = JSON.parse(response);
			for (var i = invitaciones.length - 1; i >= 0; i--) {
				alertify.log(invitaciones[i]["nombre_jugador"] + " " + invitaciones[i]["apellido_jugador"] + " te invito a '<a href=javascript:aceptar_invitacion("+invitaciones[i]['id_invitacion']+")>Jugar</a>'  en " + invitaciones[i]["nombre_cancha"]);
			};
		});			
			
	});

	function f1(){
			
		var datos = {};
		datos.funcion = "cantidad_invitaciones";
		$http.post("ajax/ajaxs.php",datos).
		success(function(response){
			$('#notify').html(response);
		});	
		
		alertify.log("Esto es una notificación cualquiera."); 
	}

	function aceptar_invitacion(id_invitacion){
		var datos = {};
		datos.funcion = "aceptar_invitacion";
		console.log(id_invitacion);
	}
</script>    
>>>>>>> 49b3c1445a66f3420511f9987981e993948202f7
