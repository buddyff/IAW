<?php include ("/navbar.php"); ?>
<div class="row">
    <div class="panel panel-primary col-lg-3 col panel-cancha" ng-repeat="c in ctrl.canchas">
    	<div class="panel-heading text-center">
    		{{c[1]}}
    	</div>
    	<div class="panel-body">
    		Telefono: {{c[2]}}
    		<br>
    		Direccion: {{c[4]}} {{c[5]}}, {{c[3]}}
    	</div>
	</div>    	
</div>
