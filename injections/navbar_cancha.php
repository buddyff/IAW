<?php include("../config.php"); ?>

   <div id="navbar-ppal-cancha">
        <nav class="navbar navbar-inverse"  >
            <div class="navbar-header">
                <a class="navbar-brand" href="#/inicio_cancha">Fulbito App</a>
            </div>
          
            <ul class="nav navbar-nav pull-right">
                <li>
                    <div class="btn-group boton-cerrar-sesion">
                      <button type="button"  id="navbar-btn" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <?php echo strtoupper($_SESSION['user_name']); ?><span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a data-ng-controller="logoutCtrl as c" data-ng-click="c.logout()" href="#/">Cerrar Sesion</a></li>
                      </ul>
                    </div>
                    
                     </li>  
            </ul>
        </nav>
    </div>