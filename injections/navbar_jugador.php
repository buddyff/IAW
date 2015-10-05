<?php include("../config.php"); ?>

   <div class="row">
        <nav class="navbar navbar-inverse" id="navbar-ppal-jugador" >
			<div class="navbar-header">
				<a class="navbar-brand" href="#/inicio_jugador">FULBITO</a>
			</div>
			<ul	class="nav navbar-nav">
				<li><a href="#/historial">HISTORIAL/ESTADISTICAS</a> </li>
				<li><a href="#/amigos">AMIGOS</a> </li>
				<li><a href="#/cancha">VER CANCHAS</a></li>
			</ul>
			<ul class="pull-right nav navbar-nav >">
				<li>
					<div class="btn-group">
					  <button type="button"  id="navbar-btn" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					     <?php echo strtoupper($_SESSION['user_name']); ?><span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="#">Action</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a data-ng-controller="logoutCtrl as c" data-ng-click="c.logout()" >Cerrar Sesion</a></li>
					  </ul>
					</div>
					
					 </li>	
			</ul>
        </nav>
    </div>
<script>
    $(document).ready(function(){
        
        
    });
</script>