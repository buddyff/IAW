<?php
include ("head.php");
include ("config.php");
?>
<script src="modules/app.js"></script>

<html ng-app="app"  >
    <body class="body-index">
            <?php include ("injections/navbar.php"); ?>
             
          <div class="container-fluid" ng-view > 
          </div>        
           <?php include ("injections/footer.php");?>
   </body>    
</html>