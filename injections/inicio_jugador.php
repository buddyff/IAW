<?php 
	include ("navbar_jugador.php");
	include ("../Modales/invitar_amigos.php");
?>

<div class="col-lg-4 col-lg-offset-4">
    <div class="row">
        <div class="panel" id="panel-turnos" ng-show="ctrl.cant_turnos > 0">
            <div class="panel-heading text-center">
                <h2>TURNO</h2>
            </div>
            <div class="panel-body">
                <input hidden type="text"></input>
                <div class="row">
                    <div class="col-lg-5 text-center">
                        Cancha  <h2 id="turno_cancha">{{ctrl.turnos[ctrl.turno_actual]["nombre"]}}</h1></br>
                    </div>
                    <div class="col-lg-7 text-center">
                        Fecha  <h2 id="turno_fecha">{{ctrl.turnos[ctrl.turno_actual]["fecha"]}}</h1></br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h3>Hora : {{ctrl.turnos[ctrl.turno_actual]["horario"]}}</h3>
                    </div>
                </div>
              
            </div>
            <div class="panel-footer text-center">
                <div ng-show="ctrl.disponibilidad=='disponible'">
                     <button class="btn"  ng-click="ctrl.registrar()">REGISTRAR</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='lleno'">
                     <button class="btn" disabled>LLENO</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='registrado'">
                     <button class="btn" ng-click="ctrl.salir()">SALIR</button>
                </div>
                <br>
                <div>
                	<button class="btn " ng-click="ctrl.invitar_amigos()">Invita un amigo</button>
                </div>
            </div>
        </div>
        <h1 ng-show="ctrl.cant_turnos == 0"> No hay turnos para registrarse ! </h1>
    </div>
</div>
<div class="col-lg-4  col-lg-offset-4 text-center" ng-show="ctrl.cant_turnos > 0">
    <div class="row">
        <button type="button" class="btn" ng-click="ctrl.anterior_turno()">
            <span aria-hidden="true">&laquo;</span>
        </button>
        <button type="button" class="btn" ng-click="ctrl.siguiente_turno()">
            <span aria-hidden="true">&raquo;</span>
         </button>
     </div>
</div>

