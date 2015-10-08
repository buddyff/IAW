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
				var params = invitaciones[i]["nombre_cancha"]+","+invitaciones[i]['id_invitacion']+","+invitaciones[i]['dia']+","+invitaciones[i]['hora'];
			console.log("ESTOS SON OS PARAMETROS " + params);
				 alertify.notify(invitaciones[i]["nombre_jugador"] + " " + invitaciones[i]["apellido_jugador"] + " <a href=javascript:aceptar_invitacion("+String(params)+")>te invito a jugar</a>  en " + invitaciones[i]["nombre_cancha"]
				 	, 'custom', 55);
				//alertify.log(invitaciones[i]["nombre_jugador"] + " " + invitaciones[i]["apellido_jugador"] + " te invito a '<a href=javascript:aceptar_invitacion("+invitaciones[i]['id_invitacion']+")>Jugar</a>'  en " + invitaciones[i]["nombre_cancha"]);
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
		
	}

	function aceptar_invitacion(cancha,id_invitacion,dia,hora){
		var datos = {};
		console.log("A confirmar");
		alertify.confirm("Confimar invitacion","Jugas el "+dia+" a las "+hora+" en "+cancha ,
		function(){
			datos.funcion = "aceptar_invitacion";
			$http.post("ajax/ajax_sin_angular.php",datos).
			success(function(response){
				alertify.success('Ok');//REALIZAR LLAMADA AJAX!
			});			
		},
		function(){
			datos.funcion = "eliminar_invitacion";
		}).setting('labels',{'ok':'Accept', 'cancel': 'Decline'});

		console.log("ID INVITACION : " + id_invitacion);
	}
</script>    

