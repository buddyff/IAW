<?php 
    include ("navbar_cancha.php");
?>

<div class="col-lg-5">
    <div class="text-center" id="resultados-por-cargar" data-ng-show="ctrl.hay_turnos_por_cargar">RESULTADOS POR CARGAR</div>
    <div class="text-center" id="no-resultados-por-cargar" data-ng-show="!ctrl.hay_turnos_por_cargar">NO HAY RESULTADOS POR CARGAR</div>
    <div class="row">
        <i class="fa fa-check-square-o fa-5x text-center col-lg-offset-4" data-ng-show="!ctrl.hay_turnos_por_cargar" style="font-size: 15em;margin-top:65px;"></i>
        <div class="panel panel-success" id="panel-turnos-cargar" data-ng-show="ctrl.hay_turnos_por_cargar">
            <div class="panel-heading text-center">
                <h4 >{{ctrl.cargar_fecha}}</h4>
            </div>
            <div class="panel-body" >
                <div class="row">
                    <div class="col-lg-6 text-center">
                       <div class="row"><h4>Equipo 1</h4></div>
                       <div class="row">{{ctrl.nombre_cargar_11}}</div>
                       <div class="row">{{ctrl.nombre_cargar_12}}</div>
                       <div class="row">{{ctrl.nombre_cargar_13}}</div>
                       <div class="row">{{ctrl.nombre_cargar_14}}</div>
                       <div class="row">{{ctrl.nombre_cargar_15}}</div> 
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="row"><h4>Equipo 2</h4></div>
                        <div class="row">{{ctrl.nombre_cargar_21}}</div>
                        <div class="row">{{ctrl.nombre_cargar_22}}</div>
                        <div class="row">{{ctrl.nombre_cargar_23}}</div>
                        <div class="row">{{ctrl.nombre_cargar_24}}</div>
                        <div class="row">{{ctrl.nombre_cargar_25}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h3>Hora : {{ctrl.cargar_horario}}</h3>
                    </div>
                </div>
              
            </div>
            
            <div class="panel-footer text-center">
               
                    <div class="row">
                        <div class="col-lg-6 text-center">Equipo 1</div>
                        <div class="col-lg-6 text-center">Equipo 2</div> 
                    </div> 
                    <div class="row">
                        <input class="col-lg-2 col-lg-offset-2 text-center" type="text" data-ng-model="ctrl.resultado_0"></input>
                        <input class="col-lg-2 col-lg-offset-4 text-center" type="text" data-ng-model="ctrl.resultado_1"></input>
                    </div>
                 
                <div class="row">
                    <button class="btn btn-success" id="cargar-resultado" data-ng-click="ctrl.cargar_resultado()">CARGAR</button>
                </div>                  
            </div>
        </div>
    </div>
    <div class="col-lg-4  col-lg-offset-4 text-center" data-ng-show="ctrl.hay_turnos_por_cargar">
        <div class="row">
            <button type="button" class="btn btn-success" data-ng-click="ctrl.anterior_turno_cargar()">
                <span aria-hidden="true">&laquo;</span>
            </button>
            <button type="button" class="btn btn-success" data-ng-click="ctrl.siguiente_turno_cargar()">
                <span aria-hidden="true">&raquo;</span>
             </button>
         </div>
    </div>
</div>
<div class="col-lg-4 col-lg-offset-2">
    <div class="text-center" id="partido-actual">JUGÁNDOSE !!!</div>
    <div class="row">
        <div class="panel panel-success" id="panel-turno-jugandose">
            <div class="panel-heading text-center">
                
                <span class="fa fa-futbol-o fa-3x"></span>

            </div>
            <div class="panel-body" data-ng-show="ctrl.hay_turno">
                
                <div class="row">
                    <div class="col-lg-6 text-center">
                       <div class="row"><h4>Equipo 1</h4></div>
                       <div class="row">{{ctrl.j_11}}</div>
                       <div class="row">{{ctrl.j_12}}</div>
                       <div class="row">{{ctrl.j_13}}</div>
                       <div class="row">{{ctrl.j_14}}</div>
                       <div class="row">{{ctrl.j_15}}</div> 
                    </div>
                    <div class="col-lg-6 text-center">
                        <div class="row"><h4>Equipo 2</h4></div>
                        <div class="row">{{ctrl.j_21}}</div>
                        <div class="row">{{ctrl.j_22}}</div>
                        <div class="row">{{ctrl.j_23}}</div>
                        <div class="row">{{ctrl.j_24}}</div>
                        <div class="row">{{ctrl.j_25}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h3>Hora : {{ctrl.horario}}</h3>
                    </div>
                </div>
              
            </div>
            <div class="panel-body" data-ng-show="!ctrl.hay_turno">
              <h4 class="text-center"> NO HAY NING&Uacute;N TURNO JUGANDOSE ACTUALMENTE</h4>              
            </div>
          
        </div>
    </div>
</div>
