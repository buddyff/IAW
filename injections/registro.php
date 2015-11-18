<div class="col-lg-4 col-lg-offset-4" style="padding-top:150px;">
    <div class="row">
        <div class="panel panel-index ">
            <div class="panel-heading text-center">
                Registro <i class="fa fa-user-plus"></i>
            </div>
             <div class="panel-body" >
                <form name="formulario" data-ng-submit="ctrl.sign_up()">
                    <div class="form-group ">
                        <label>Nombre:</label>
                        <input class="col-lg-9 pull-right text-center" ng-required="true"  name="nombre" type="text" data-ng-model="ctrl.datos.nombre" />
                        <p ng-show="formulario.nombre.$invalid && !formulario.nombre.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá tu nombre</p>
                    </div>
                    <div class="form-group ">
                        <label>Apellido:</label>
                        <input class="col-lg-9 pull-right text-center" ng-required="true" name="apellido" type="text" data-ng-model="ctrl.datos.apellido" />
                        <p ng-show="formulario.apellido.$invalid && !formulario.apellido.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá tu apellido</p>
                    </div>
                    <div class="form-group">
                        <label>Edad:</label>
                        <input class="col-lg-9 pull-right text-center" ng-required="true" name="edad" type="text" data-ng-model="ctrl.datos.edad" />
                        <p ng-show="formulario.edad.$invalid && !formulario.edad.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá tu edad</p>
                    </div>
                    <div class="form-group">
                        <label>Direccion:</label>
                        <input class="col-lg-9 pull-right text-center" type="text" data-ng-model="ctrl.datos.direccion" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="col-lg-9 pull-right text-center" ng-required="true" name="email" type="email" data-ng-model="ctrl.datos.email" />
                        <p ng-show="formulario.email.$invalid && !formulario.email.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá tu correo</p>
                    </div>
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input class="col-lg-9 pull-right text-center" type="text"  data-ng-model="ctrl.datos.telefono" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input class="col-lg-9 pull-right text-center" name="password" ng-required="true" type="password" data-ng-model="ctrl.datos.password" />
                        <p ng-show="formulario.password.$invalid && !formulario.password.$pristine" class="help-block text-center" style="color:#FFFFFF">Ingresá una contraseña</p>
                    </div>
                    
                    <div class="form-group">
                        <span class="input-group-btn">
                            <button type"submit" class="btn btn-default col-lg-12" ng-disabled="formulario.$invalid">Registrar</button>
                            
                        </span>    
                    </div>
                 </form>
            
            </div>
            
        </div>
    </div>
</div>