<?php include ("../config.php"); ?>

<div class="col-lg-12">
   <div class="row">
        <nav class="navbar navbar-inverse" id="navbar-ppal">
			<div class="navbar-header">
				<a class="navbar-brand" href="#/mi_cuenta">FULBITO</a>
			</div>
			<ul	class="nav navbar-nav">
				<li><a href="">VER PARTIDOS</a> </li>
				<li><a>ESTAD&Iacute;STICAS</a> </li>
				<li><a href="#/amigos">AMIGOS</a> </li>
				<li><a href="#/cancha">VER CANCHAS</a></li>
			</ul>
			<ul class="pull-right nav navbar-nav >">
				<li>
					<div class="btn-group">
					  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					    <?php echo strtoupper($_SESSION['user_name']);?> <span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu">
					    <li><a href="#">Action</a></li>
					    <li role="separator" class="divider"></li>
					    <li><a href="../IAW">Cerrar Sesion</a></li>
					  </ul>
					</div>
					
					 </li>	
			</ul>
        </nav>
    </div>
</div>