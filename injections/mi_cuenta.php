<div class="col-lg-12">
   <div class="row">
        <nav class="navbar navbar-inverse" style="margin-bottom: 100px">
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
        <table class="table table-striped" id="tabla-turnos" >
            <thead>
                <th>Fecha y Hora</th>
                <th>Cancha</th>
                <th>Jugador 1</th>
                <th>Jugador 2</th>
                <th>Jugador 3</th>
                <th>Jugador 4</th>
                <th>Jugador 5</th>
                <th>Jugador 6</th>
                <th>Jugador 7</th>
                <th>Jugador 8</th>
                <th>Jugador 9</th>
                <th>Jugador 10</th>
                <th></th>
            </thead>
            <tbody >
                <tr ng-repeat="t in ctrl.turnos">
                    
                    <td scope="row">{{t[13]}}</td> <!--Fecha y hora-->
                    <td>{{t[16]}}</td> <!--Cancha-->
                    <td>{{t[2]}}</td>  <!--Jugador 1-->
                    <td>{{t[3]}}</td>  <!--Jugador 2-->
                    <td>{{t[4]}}</td>  <!--Jugador 3-->
                    <td>{{t[5]}}</td>  <!--Jugador 4-->
                    <td>{{t[6]}}</td>  <!--Jugador 5-->
                    <td>{{t[7]}}</td>  <!--Jugador 6-->
                    <td>{{t[8]}}</td>  <!--Jugador 7-->
                    <td>{{t[9]}}</td>  <!--Jugador 8-->
                    <td>{{t[10]}}</td> <!--Jugador 9-->
                    <td>{{t[11]}}</td>  <!--Jugador 10-->
                    <td><button class="btn-success">Registrar</button></td>
                </tr>
            </tbody>
            
        </table>
    </div>
</div>