<?php include ("../config.php"); ?>

<div class="col-lg-12">
   <div class="row">
        <nav class="navbar navbar-inverse" id="navbar-ppal">
			<div class="navbar-header">
				<a class="navbar-brand" href="#/mi_cuenta">FULBITO</a>
			</div>
			<ul	class="nav navbar-nav">
				<li><a href="google.com">VER PARTIDOS</a> </li>
				<li><a>ESTAD&Iacute;STICAS</a> </li>
				<li><a href="#/amigos">AMIGOS</a> </li>
				<li><a href="#/cancha">VER CANCHAS</a></li>
			</ul>
			<ul class="pull-right nav navbar-nav >"><li><a><?php echo strtoupper($_SESSION['user_name']);?> </a> </li>	</ul>
        </nav>
    </div>
</div>
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
                        Cancha  <h2 id="turno_cancha">{{ctrl.turnos[ctrl.turno_actual][17]}}</h1></br>
                    </div>
                    <div class="col-lg-7 text-center">
                        Fecha  <h2 id="turno_fecha">{{ctrl.turnos[ctrl.turno_actual][13]}}</h1></br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3 text-center">
                        <h3>Hora : {{ctrl.turnos[ctrl.turno_actual][14]}}</h3>
                    </div>
                </div>
              
            </div>
            <div class="panel-footer text-center">
               <button class="btn btn-success">REGISTRARSE</button>
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