<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {

		include("configCSS_adm.html");
		include("header_op.php");

	} else if ($_SESSION['userName'] == 'Root') {

		include("configCSS_adm.html");
		include("header_op.php");

	} else {

		include("configCSS.html");
		include("header.php");

	}
} else {

	include("configCSS.html");
	include("header.php");

}

function get_session() {
    if(isset($_SESSION['userName'])) {
        return $_SESSION['userName'];
    } else {
        return '';
    }
}

function get_login() {
    if(isset($_SESSION['login'])) {
        return $_SESSION['login'];
    } else {
        return '';
    }
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

    <br><br>
    <form method="post" class="formulaire2" action="insert_product.php">
        <p style="text-align:center">Ajouter un produit : <br></p>
        <input type="radio" name="produit" class="checkoption" value="1" required> Machine <br> <!-- Machine -->
        <input type="radio" name="produit" class="checkoption" value="2" required> Filament <br> <!-- Filament -->
        <input type="radio" name="produit" class="checkoption" value="3" required> Accessoire <br> <!-- Accessoire -->
        <p><input type="submit" value="OK"></p>
    </form>

    <br><br>

    <form method="post" class="formulaire2" action="insert_product_type.php">
        <p style="text-align:center">Ajouter/Modifier/Supprimer un type de produit : <br></p>

        Machine :
        <input type="button" value="Ajouter" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=1&modif=1';">
        <input type="button" value="Modifier" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=1&modif=2';">
        <input type="button" value="Supprimer" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=1&modif=3';">

        <br><br>

        Filament :
        <input type="button" value="Ajouter" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=2&modif=1';">
        <input type="button" value="Modifier" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=2&modif=2';">
        <input type="button" value="Supprimer" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=2&modif=3';">

        <br><br>

        Accessoire :

        <input type="button" value="Ajouter" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=3&modif=1';">
        <input type="button" value="Modifier" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=3&modif=2';">
        <input type="button" value="Supprimer" onclick="window.location.href='http://localhost/ProjetSQL-main/insert_product_type.php?product=3&modif=3';">

    </form>





  </body>
</html>