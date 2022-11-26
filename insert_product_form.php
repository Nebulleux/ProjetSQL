<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu(e) utilisateur.rice '.$_SESSION['login'].'</h1>';

	} else if ($_SESSION['userName'] == 'Root') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu(e) administrateur.rice '.$_SESSION['login'].'</h1>';

	} else {

		include("configCSS.html");
		include("header.php");

	}
} else {

	include("configCSS.html");
	include("header.php");

}
include("config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insertion d'un produit</title>
  </head>
  <body>


    <form method="post" class="centre" action="insert_product.php">
        <input type="radio" name="machine" class="checkoption" value="1" onclick="checkedOnClick(this);"> Machine <br>
        <input type="radio" name="filament" class="checkoption" value="2" onclick="checkedOnClick(this);"> Filament <br>
        <input type="radio" name="accessoire" class="checkoption" value="3" onclick="checkedOnClick(this);"> Accessoire <br>
        <p><input type="submit" value="OK"></p>
    </form>





  </body>
</html>