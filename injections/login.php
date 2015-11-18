<?php include ("../Modales/login_incorrecto.php"); ?>
<link href="css/bootstrap-switch.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/bootstrap-switch.min.js"></script>


<div class="col-lg-4 col-lg-offset-4" style="padding-top:150px;">
    <div class="row">
        
        <div class="panel panel-index ">
            <div class="panel-heading text-center">
                Login
            </div>
             <div class="panel-body">
                <form id="formulario" name="formulario">
                    <div class="form-group text-center">
                        <input type="checkbox" class="form-control" id="tipo-usuario"/>
                    </div>
                	<div class="form-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input class="form-control text-center" id="email" ng-required="true" name="email" type="email" placeholder="Ingresá tu email" data-ng-model="ctrl.datos.email"/>
                        <p ng-show="formulario.email.$invalid  && !formulario.email.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá un email válido</p>
                    </div>
                    <div class="form-group">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>    
                        <input class="form-control text-center" id="pass" ng-required="true" name="pass" type="password" placeholder="Ingresa tu password" data-ng-model="ctrl.datos.pass"/>
                        <p ng-show="formulario.pass.$invalid && !formulario.pass.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá tu contraseña</p>
                    </div>
                    <div class="form-group">
                        <button type"button" ng-click="ctrl.enviar_jugador()" ng-disabled="formulario.$invalid" class="btn btn-default col-lg-6 col-lg-offset-3 " id="ingresar-jugador-btn">Ingresar</button>
                        <button type"button" ng-click="ctrl.enviar_cancha()" ng-disabled="formulario.$invalid" class="btn btn-default col-md-6 col-lg-offset-3 hidden" id="ingresar-cancha-btn">Ingresar</button>
                    </div>
                 </form>
	            <div class="pull-right">
	            	¿Todavía no estas registrado? <a href="#/registro">Registrate</a>
	            </div>
            </div>
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        
         
        $("#tipo-usuario").bootstrapSwitch();
        $("#tipo-usuario").bootstrapSwitch('onText',"Cancha");
        $("#tipo-usuario").bootstrapSwitch('offText',"Jugador");
        $("#tipo-usuario").bootstrapSwitch('offColor','primary');
        
        $('#tipo-usuario').on('switchChange.bootstrapSwitch', function(event, state) {
            switch(state){
                case true:{
                    $("#ingresar-jugador-btn").addClass("hidden");
                    $("#ingresar-cancha-btn").removeClass("hidden");
                    break;
                }
                case false:{
                    $("#ingresar-jugador-btn").removeClass("hidden");
                    $("#ingresar-cancha-btn").addClass("hidden");
                    break;
                }
            }
       });
     
     
   
                    
    });
</script>