<?php include ("navbar_jugador.php");?>

<div class="row">
    <div class="panel col-lg-3 col panel-cancha" ng-repeat="c in ctrl.canchas">
    	<div class="panel-heading text-center">
    		{{c["nombre"]}}
    	</div>
    	<div class="panel-body">
    		Telefono: {{c["telefono"]}}
    		<br>
    		Direccion: {{c["ciudad"]}}, {{c["calle"]}} {{c["calle_numero"]}}
    	</div>
	</div>    	
</div>
