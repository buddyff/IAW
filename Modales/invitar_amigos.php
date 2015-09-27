<div id="invitar_amigos" class="modal fade">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
           <div class="modal-header text-center">
               <h4 class="modal-title">Amigos</h4>
            </div>
           
           <div class="modal-body text-center">
	           	<table class="table table-hover">
	           		<tbody ng-repeat="a in ctrl.amigos">
	           			<tr>
			                <th><p>{{a["Nombre"]}} {{a["Apellido"]}}</p></th>
			                <th ng-show="ctrl.registrado[a['Id']] == 'no'"><button class="btn btn-success" ng-click="ctrl.invitar(a['Id'])">Invitar</button></th>
			                <th ng-show="ctrl.registrado[a['Id']] == 'si'"><button class="btn">Registrado</button></th>
			                <th ng-show="ctrl.registrado[a['Id']] == 'invitado'"><button class="btn">Invitado</button></th>
		                </tr>
	                </tbody>
	            </table>
           </div>
           
           <div class="modal-footer text-center">
               <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
           </div>
       </div>
    </div>
</div>