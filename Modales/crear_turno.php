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