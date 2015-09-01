<div class="col-lg-12">
   <div class="row">
        <nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="#/mi_cuenta">Fulbito</a>
			</div>
			<ul	class="nav navbar-nav">
				<li><a>Ver Partidos</a> </li>
				<li><a>Estad&iacute;sticas</a> </li>
				<li><a>Amigos</a> </li>
				<li><a>Ver Canchas</a></li>
			</ul>
			<ul class="pull-right nav navbar-nav >"><li><a>Nombre</a> </li>	</ul>
        </nav>
    </div>
    <div class="row">
        <div ng-repeat="t in ctrl.turnos">   
            <div>{{t}}</div>
        </div>
    </div>
</div>