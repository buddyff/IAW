<?php 
    include ("navbar_cancha.php");
?>
<div class="row">
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
                            <form id="formulario_2" name="formulario_2"> 
                                <div class="form-group col-lg-4 col-lg-offset-1">
                                    <input class="form-control text-center" id="resultado_0" name="resultado_0" type="text" data-ng-model="ctrl.resultado_0" ng-required="true" ng-pattern="/^[0-9]*$/"></input>
                                    <p ng-show="formulario_2.resultado_0.$invalid  && !formulario_2.resultado_0.$pristine" class="help-block text-center">Ingresá un resultado válido</p>
                                </div>
                                <div class="form-group col-lg-4 col-lg-offset-2">
                                    <input class="form-control text-center" type="text" id="resultado_1" name="resultado_1" ng-required="true" ng-pattern="/^[0-9]*$/" data-ng-model="ctrl.resultado_1"></input>
                                    <p ng-show="formulario_2.resultado_1.$invalid  && !formulario_2.resultado_1.$pristine" class="help-block text-center">Ingresá un resultado válido</p>
                                </div>
                           </form>
                        </div>
                     
                    <div class="row">
                        <button class="btn btn-success" id="cargar-resultado" ng-disabled="formulario_2.$invalid" data-ng-click="ctrl.cargar_resultado(formulario_2)">CARGAR</button>
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
</div>    

<div class="row col-lg-12 text-center" ng-show="ctrl.hay_turnos_por_cargar">
    <button class="btn btn-warning btn-lg" id="crear-turno-btn" onclick="display_modal()">Crear Turno</button>
</div>
<div class="row col-lg-12 text-center" ng-show="!ctrl.hay_turnos_por_cargar" style="margin-top:150px">
    <button class="btn btn-warning btn-lg" id="crear-turno-btn" onclick="display_modal()">Crear Turno</button>
</div>



<!-----------------------------------------
           MODAL PARA CREAR TURNO               
------------------------------------------->

<div class="modal fade" id="crear-turno-modal" data-ng-model="ctrl.modal_turno">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">Crear Turno</h4>
      </div>
      <div class="modal-body">
          <form id="formulario" name="formulario">
            <div class="row">
                <div class="form-group col-lg-6 text-center">
                    <label>Fecha</label>
                    <input class="form-control text-center" type="text" placeholder="dd-mm-aaaa" name="fecha" id="fecha" ng-required="true" ng-pattern="/(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/" data-ng-model="ctrl.fecha" />
                    <p ng-show="formulario.fecha.$invalid  && !formulario.fecha.$pristine" class="help-block text-center">Ingresá una fecha válida</p>
                </div>
                <div class="form-group col-lg-6 text-center">
                    <label>Hora</label>
                    <input class="form-control text-center" ng-required="true" ng-pattern="/^(?:[01]\d|2[0-3]):[0-5]\d$/" placeholder="hh:mm" id="hora" name="hora" data-ng-model="ctrl.hora">
                    <p ng-show="formulario.hora.$invalid  && !formulario.hora.$pristine" class="help-block text-center">Ingresá una hora válida</p>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
          <div class="row text-center">
            <button type="button" class="btn btn-danger" ng-click="ctrl.reset(formulario)">Cerrar</button>
            <button type="button" class="btn btn-success" ng-disabled="formulario.$invalid" data-ng-click="ctrl.crear_turno(formulario)">Crear turno</button>
          </div>
      </div>
    </div>
  </div>
</div>


<!-----------------------------------------
           MODAL PARA TURNO CREADO              
------------------------------------------->
<div class="modal fade" id="turno-ok">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-center">&Eacute;xito</h4>
      </div>
      <div class="modal-body text-center">
        Turno creado correctamente
      </div>
      <div class="modal-footer">
          <div class="row text-center">
            <button type="button" class="btn btn-success" data-dismiss="modal">Aceptar</button>
          </div>
      </div>
    </div>
  </div>
</div>

<script>
   
    
   function display_modal(){
        $("#crear-turno-modal").modal("show");
   }
    
</script>