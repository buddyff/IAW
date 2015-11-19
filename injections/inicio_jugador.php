<?php 
   require ("navbar_jugador.php");
   include ("../Modales/invitar_amigos.php");
?>

<div class="col-lg-4 col-lg-offset-1">
    <div class="panel panel-default" id="panel-puntajes">
        <div class="panel-heading text-center" >
            <span class="fa fa-table fa-3x"></span>
        </div>
        <div class="panel-body">
            <table class="table table-hover" id="tabla-puntajes">
                <thead>
                    <tr>
                       <th class="text-center"><h3>Amigo</h3></th>
                       <th class="text-center"><h3>PJ</h3></th>
                       <th class="text-center"><h3>PG</h3></th>
                       <th class="text-center"><h3>PE</h3></th>
                       <th class="text-center"><h3>PP</h3></th>
                       <th class="text-center"><h3>Puntos</h3></th>
                    </tr>
                </thead>
                <tbody ng-repeat="c in ctrl.puntajes">
                    <th class="text-center"><h4>{{c["Nombre"]}}</h4></th>
                    <th class="text-center"><h4>{{c["Pj"]}}</h4></th>
                    <th class="text-center"><h4>{{c["Pg"]}}</h4></th>
                    <th class="text-center"><h4>{{c["Pe"]}}</h4></th>
                    <th class="text-center"><h4>{{c["Pp"]}}</h4></th>
                    <th class="text-center"><h4>{{c["Puntaje"]}}</h4></th>
                </tbody>
            </table>
         </div>
    </div>
</div>

<div class="col-lg-4 col-lg-offset-2">
    <div class="row" ng-show="ctrl.cant_turnos > 0">
        <div class="panel panel-default" id="panel-turnos">
            <div class="panel-heading text-center">
                <span class="fa fa-sign-in fa-3x"></span>
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
                     <button class="btn btn-default"  ng-click="ctrl.registrar()">REGISTRAR</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='lleno'">
                     <button class="btn" disabled>LLENO</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='registrado'">
                     <button class="btn btn-default" ng-click="ctrl.salir()">SALIR</button>
                </div>
                <br>
                <div>
                	<button class="btn btn-default" ng-show="!ctrl.lleno" ng-click="ctrl.invitar_amigos()">Invita un amigo</button>
                </div>
            </div>
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
    
</div>
<div class="col-lg-6 col-lg-offset-1" ng-show="ctrl.cant_turnos == 0">
        <div id="no-turnos-registrarse"> No hay turnos para registrarse ! </div>
        <i class="fa fa-thumbs-o-down fa-5x text-center col-lg-offset-3" data-ng-show="!ctrl.hay_turnos_por_cargar" style="font-size: 15em;margin-top:65px;"></i>
    </div>

