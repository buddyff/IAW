<div class="col-lg-4 col-lg-offset-4" style="padding-top:50px;">
    <div class="row">
        <div class="panel panel-index ">
            <div class="panel-heading text-center">
                Registro <i class="fa fa-user-plus"></i>
            </div>
             <div class="panel-body" >
                <form data-ng-submit="ctrl.sign_up()">
                    <div class="form-group ">
                        <label>Nombre:</label>
                        <input class="col-lg-9 pull-right text-center" type="text" data-ng-model="ctrl.datos.nombre" />
                    </div>
                    <div class="form-group ">
                        <label>Apellido:</label>
                        <input class="col-lg-9 pull-right text-center" type="text" data-ng-model="ctrl.datos.apellido" />
                    </div>
                    <div class="form-group">
                        <label>Edad:</label>
                        <input class="col-lg-9 pull-right text-center" type="text" data-ng-model="ctrl.datos.edad" />
                    </div>
                    <div class="form-group">
                        <label>Direccion:</label>
                        <input class="col-lg-9 pull-right text-center" type="text" data-ng-model="ctrl.datos.direccion" />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="col-lg-9 pull-right text-center" type="email" data-ng-model="ctrl.datos.email" />
                    </div>
                    <div class="form-group">
                        <label>Teléfono:</label>
                        <input class="col-lg-9 pull-right text-center" type="text"  data-ng-model="ctrl.datos.telefono" />
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input class="col-lg-9 pull-right text-center" type="password" data-ng-model="ctrl.datos.password" />
                    </div>
                    
                    <div class="form-group">
                        <span class="input-group-btn">
                            <button type"submit" class="btn btn-default col-lg-12 ">Registrar</button>
                            
                        </span>    
                    </div>
                 </form>
            
            </div>
            
        </div>
    </div>
</div>