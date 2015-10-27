<?php include ("navbar_jugador.php");?>

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
            Direccion: {{c["Direccion"]}}
            <br>
            Edad:  {{c["Edad"]}}
            <br>
            Mail:  {{c["Email"]}}
        </div>
    </div>
    <div class="panel panel-success col-lg-3 col panel-cancha" ng-repeat="c in ctrl.jugadores">
    	<div class="panel-heading text-center" style="background-image=">
    		{{c["Nombre"]}}  {{c["Apellido"]}}
    	</div>
    	<div class="panel-body">
            <div class="row">
                <div class="col-lg-8">

                    Puntaje:  {{c["Puntaje"]}} 
                    <br>
                    Telefono: {{c["Telefono"]}}
                    <br>
                    Edad:  {{c["Edad"]}}  
                    <br>
                    Mail:  {{c["Email"]}}
                <br>
                </div>
                <div class="col-lg-4">
                    <i class="fa fa-user-plus fa-4x"></i>
                </div>
            </div>
    	</div>
	</div>	
</div>