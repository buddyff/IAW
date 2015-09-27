<div class="row">
    <div class="panel panel-primary col-lg-3 col panel-cancha" ng-repeat="c in ctrl.amigos">
    	<div class="panel-heading text-center">
    		{{c[0]}}  {{c[1]}}
    	</div>
    	<div class="panel-body">
    		Puntaje:  {{c[2]}} 
    		<br>
    		Telefono: {{c[4]}}
    		<br>
    		Direccion:  {{c[3]}}
    		<br>
    		Edad:  {{c[5]}}
    		<br>
    		Mail:  {{c[6]}}
    	</div>
	</div>	
</div>