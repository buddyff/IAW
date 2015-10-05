<?php 
    include ("navbar_cancha.php");
?>
<div class="col-lg-4 col-lg-offset-4">
    <div class="row">
        <div class="panel panel-success" id="panel-turno-jugandose">
            <div class="panel-heading text-center">
                <h2>JUG&Aacute;NDOSE !</h2>
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
          <!--   <div class="panel-footer text-center" data-ng-show="ctrl.hay_turno">
               <div class="row"><h4>Resultado</h4></div>
               
               <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="row">Equipo 1</div> 
                        <div class="row"><input type="radio"/></div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="row">Empate</div> 
                        <div class="row"><input type="radio"/></div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <div class="row">Equipo 2</div> 
                        <div class="row"><input type="radio"/></div>
                    </div>
                </div>                    
            </div>-->
        </div>
    </div>
</div>
<