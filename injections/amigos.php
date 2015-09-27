<?php include ("navbar.php");?>

<div class="row">
    <div class="panel panel-primary col-lg-3 col panel-cancha" ng-repeat="c in ctrl.amigos">
    	<div class="panel-heading text-center">
    		{{c["Nombre"]}}  {{c["Apellido"]}}
    	</div>
    	<div class="panel-body">
    		Puntaje:  {{c["Puntaje"]}} 
    		<br>
    		Telefono: {{c["Telefono"]}}
    		<br>
    		Direccion:  {{c["Direccion"]}}
    		<br>
    		Edad:  {{c["Edad"]}}
    		<br>
    		Mail:  {{c["Email"]}}
    	</div>
	</div>	
</div>