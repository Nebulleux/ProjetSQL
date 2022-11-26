<?php
include("../status/connected.php");
include("header_op.php"); 
include("../config.php");
include("configCSS_adm.html");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insertion d'un produit</title>
  </head>
  <body>


    <form method="post" class="centre" action="insert_product.php">
        <input type="checkbox" name="machine" class="checkoption" value="1" onclick="checkedOnClick(this);"> Machine <br>
        <input type="checkbox" name="filament" class="checkoption" value="2" onclick="checkedOnClick(this);"> Filament <br>
        <input type="checkbox" name="accessoire" class="checkoption" value="3" onclick="checkedOnClick(this);"> Accessoire <br>
        <p><input type="submit" value="OK"></p>
    </form>

   <!-- Script -->
   <script type="text/javascript">
   function checkedOnClick(el){

      // Select all checkboxes by class
      var checkboxesList = document.getElementsByClassName("checkoption");
      for (var i = 0; i < checkboxesList.length; i++) {
         checkboxesList.item(i).checked = false; // Uncheck all checkboxes
      }

      el.checked = true; // Checked clicked checkbox
   }
   </script>






  </body>
</html>