<?php include("../config.php");?>

   <div class="row">
        <nav class="navbar navbar-inverse" id="navbar-ppal-jugador" >
			<div class="navbar-header">
				<a class="navbar-brand" href="#/inicio_jugador">Fulbito App</a>
			</div>
			<ul	class="nav navbar-nav">
    			<li><a href="#/historial">HISTORIAL/ESTADISTICAS</a> </li>
				<li><a href="#/jugadores">AMIGOS</a> </li>
				<li><a href="#/cancha">VER CANCHAS</a></li>

			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<span id="notify" class="badge "></span>
					<div class="btn-group boton-cerrar-sesion">
				  		<button type="button" id="navbar-btn" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				    		<?php echo strtoupper($_SESSION['user_name']); ?>
					  	</button>
					  	<ul class="dropdown-menu ">
					    	<li><a data-ng-controller="logoutCtrl as c" data-ng-click="c.logout()" href="#/">Cerrar Sesion</a></li>
					  	</ul>
					</div>
				</li>
			</ul>
        </nav>
    </div>
<script>

    $(document).ready(function(){
		var intervalo = setInterval('f1()',1000);		

		datos.funcion = "mostrar_invitaciones";
		$.post("ajax/ajax_sin_angular.php",datos).
		success(function(response){
			console.log(response);
			var invitaciones = JSON.parse(response);

			for (var i = invitaciones.length - 1; i >= 0; i--) {
				//var params = invitaciones[i]["nombre_cancha"]+","+invitaciones[i]['id_invitacion']+","+invitaciones[i]['dia']+","+invitaciones[i]['hora'];
				 alertify.notify(invitaciones[i]["nombre_jugador"] + " " + invitaciones[i]["apellido_jugador"] + " <a href=javascript:aceptar_invitacion("+invitaciones[i]['id_invitacion']+","+invitaciones[i]['id_turno']+")>te invito a jugar</a>  en " + invitaciones[i]["nombre_cancha"]
				 +" el dia " +invitaciones[i]['dia']+" a las "+invitaciones[i]['hora']	, 'custom', 30);
				//alertify.log(invitaciones[i]["nombre_jugador"] + " " + invitaciones[i]["apellido_jugador"] + " te invito a '<a href=javascript:aceptar_invitacion("+invitaciones[i]['id_invitacion']+")>Jugar</a>'  en " + invitaciones[i]["nombre_cancha"]);
			};
		});			
	});

	function f1(){
		var datos = {};
		datos.funcion = "cantidad_invitaciones";
		$.post("ajax/ajax_sin_angular.php",datos).
		success(function(response){
			$('#notify').html(response);
		});	
	}

	function aceptar_invitacion(id_invitacion,id_turno){
		var datos = {};
		alertify.confirm("Confimar invitacion","Jugas?" ,
		function(){
			console.log("Acepte invitacion");
			//datos.funcion = "aceptar_invitacion";
			//datos.id_invitacion = id_invitacion;
			//datos.id_turno = id_turno;
			//$http.post("ajax/ajax_sin_angular.php",datos).
			//success(function(response){
			//	alertify.success('Confirmaste que jugas, no nos dejes con uno menos ;)');//REALIZAR LLAMADA AJAX!
			//});
			datos= {'funcion' : 'aceptar_invitacion',
					'id_invitacion': id_invitacion,
					'id_turno': id_turno};		
			$.ajax({
			  url: 		"ajax/ajax_sin_angular.php",
			  type: 	"post",
			  dataType: "json",
			  data: 	datos,
			  success: 	function(response){
							alertify.success('Confirmaste que jugas, no nos dejes con uno menos ;)');//REALIZAR LLAMADA AJAX!
						}	
			});	
		},
		function(){
			console.log("Rechaze invitacion");
			datos.funcion = "eliminar_invitacion";
			datos.id_invitacion = id_invitacion;
			datos.id_turno = id_turno;
			$http.post("ajax/ajax_sin_angular.php",datos).
			success(function(response){
				alertify.success("Rechazaste la invitacion :/");
			});
		}).setting('labels',{'ok':'Aceptar', 'cancel': 'Rechazar'});

		console.log("ID INVITACION : --" + id_invitacion +"--");
	}
</script>    

