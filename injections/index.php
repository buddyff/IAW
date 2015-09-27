<?php include ("../Modales/login_incorrecto.php"); ?>


<div class="col-lg-4 col-lg-offset-4" style="padding-top:150px;">
    <div class="row">
        
        <div class="panel panel-index ">
            <div class="panel-heading text-center">
                Login
            </div>
             <div class="panel-body" >
                <form id="formulario">
                	<div class="form-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control text-center" type="text" placeholder="Ingresá tu email" data-ng-model="ctrl.datos.email" />
                    </div>
                    <div class="form-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>    
                        <input class="form-control text-center" type="password" placeholder="Ingresa tu password" data-ng-model="ctrl.datos.pass"/>
                    </div>
                    
                    <div class="form-group">
                        <span class="input-group-btn">
                            <button type"button" ng-click="ctrl.enviar_jugador()" class="btn btn-default col-lg-6">Ingresar Jugador </button>
                            <button type"button" ng-click="ctrl.enviar_cancha()" class="btn btn-default col-lg-6">Ingresar Cancha </button>
                        </span>    
                    </div>
                 </form>
	            <div class="pull-right">
	            	¿Todavía no estas registrado? <a href="#/registro">Registrate</a>
	            </div>
            </div>
            
        </div>
    </div>
</div>
