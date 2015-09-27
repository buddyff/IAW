<?php include ("navbar.php");?>

<div class="col-lg-6 col-lg-offset-1">
    <div class="panel panel-success" id="panel-historial">
        <div class="panel-heading text-center" ><h2>HISTORIAL</h2></div>
        <div class="panel-body">
            <table class="table table-hover" id="tabla-historial">
                <thead>
                    <tr>
                       <th class="text-center"><h3>Cancha</h3></th>
                       <th class="text-center"><h3>Fecha</h3></th>
                       <th class="text-center"><h3>Hora</h3></th>
                       <th class="text-center"><h3>Resultado</h3></th>
                    </tr>
                </thead>
                <tbody ng-repeat="c in ctrl.historial">
                    <th class="text-center"><h4>{{c["nombre"]}}</h4></th>
                    <th class="text-center"><h4>{{c["fecha"]}}</h4></th>
                    <th class="text-center"><h4>{{c["horario"]}}</h4></th>
                    <th class="text-center"><h4>{{c["resultado"]}}</h4></th>
                </tbody>
            </table>
         </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="panel panel-success" id="panel-historial">
        <div class="panel-heading text-center" ><h2>ESTADÍSTICAS</h2></div>
        <div class="panel-body" >
            <div class="row text-center"  >
                <h4>Jugados: {{ctrl.historial.length}}</h4>
                <h4>Ganados: {{ctrl.estadisticas[0]['Ganados']}}</h4>
                <h4>Empatados: {{ctrl.estadisticas[0]['Empatados']}}</h4>
                <h4>Perdidos: {{ctrl.estadisticas[0]['Perdidos']}}</h4>
                <h4>Efectividad: </h4>
            </div>
         </div>
    </div>
</div>