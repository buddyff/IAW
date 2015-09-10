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
			<ul class="pull-right nav navbar-nav >"><li><a>NOMBRE</a> </li>	</ul>
        </nav>
    </div>
    <div class="row">
        <div class="panel panel-primary col-lg-3 col panel-cancha" ng-repeat="c in ctrl.canchas">
        	<div class="panel-heading text-center">
        		{{c[1]}}
        	</div>
        	<div class="panel-body">
        		Telefono: {{c[2]}}
        		<br>
        		Direccion: {{c[4]}} {{c[5]}}, {{c[3]}}
        	</div>
    	</div>
    	
    </div>
</div>