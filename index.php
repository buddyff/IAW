<?php
include ("head.php");
include ("config.php");
?>
<script src="modules/app.js"></script>

<html ng-app="app" ng-controller="loginCtrl as ctrl1" >
    <body class="body-index">
          <div class="container-fluid">    
             
            <div class="col-lg-4 col-lg-offset-4" style="padding-top:220px;">
                <div class="row">
                    <div class="panel panel-index ">
                        <div class="panel-heading text-center">
                            Login
                        </div>
                         <div class="panel-body" >
                            <form ng-submit="ctrl1.enviar()">
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input class="form-control text-center" type="text" placeholder="Ingresá tu email" ng-model="ctrl1.datos.email" />
                                </div>
                                <div class="form-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>    
                                    <input class="form-control text-center" type="password" placeholder="Ingresa tu password" ng-model="ctrl1.datos.pass"/>
                                </div>
                                
                                <div class="form-group">
                                    <span class="input-group-btn ">
                                        <button type"submit" class="btn btn-default col-lg-6 pull-left">Ingresar   </button>
                                        <button type"button" class="btn btn-default col-lg-6 pull-right">Registrarse   </button>
                                    </span>    
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        
        
    </body>
    
    
    
    
</html>