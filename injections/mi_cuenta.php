<?php include ("navbar.php");?>

<div class="col-lg-4 col-lg-offset-4">
    <div class="row">
        <div class="panel panel-success" id="panel-turnos">
            <div class="panel-heading text-center">
                <h2>TURNO</h2>
            </div>
            <div class="panel-body">
                <input hidden type="text"></input>
                <div class="row">
                    <div class="col-lg-5 text-center">
                        Cancha  <h2 id="turno_cancha">{{ctrl.turnos[ctrl.turno_actual][8]}}</h1></br>
                    </div>
                    <div class="col-lg-7 text-center">
                        Fecha  <h2 id="turno_fecha">{{ctrl.turnos[ctrl.turno_actual][3]}}</h1></br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h3>Hora : {{ctrl.turnos[ctrl.turno_actual][4]}}</h3>
                    </div>
                </div>
              
            </div>
            <div class="panel-footer text-center">
                <div ng-show="ctrl.disponibilidad=='disponible'">
                     <button class="btn btn-success"  ng-click="ctrl.registrar()">REGISTRAR</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='lleno'">
                     <button class="btn btn-danger" disabled>LLENO</button>
                </div>
                <div ng-show="ctrl.disponibilidad=='registrado'">
                     <button class="btn btn-success" ng-click="ctrl.salir()">SALIR</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4  col-lg-offset-4 text-center">
    <div class="row">
        <button type="button" class="btn btn-success" ng-click="ctrl.anterior_turno()">
            <span aria-hidden="true">&laquo;</span>
        </button>
        <button type="button" class="btn btn-success" ng-click="ctrl.siguiente_turno()">
            <span aria-hidden="true">&raquo;</span>
         </button>
     </div>
</div>

