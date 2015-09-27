<?php
include ("head.php");
include ("config.php");
include ("Modales/login_incorrecto.php");
?>
<script src="modules/app.js"></script>

<html ng-app="app"  >
    <body class="body-index">
            
          <div class="container-fluid" ng-view > 
          </div>        
           <?php include ("injections/footer.php");?>
   </body>    
</html>