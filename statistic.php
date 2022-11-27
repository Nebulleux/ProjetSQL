<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu utilisateur '.$_SESSION['login'].'</h1>';

	} else if ($_SESSION['userName'] == 'Root') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu administrateur '.$_SESSION['login'].'</h1>';

	} else {

		include("configCSS.html");
		include("header.php");

	}
} else {

	include("configCSS.html");
	include("header.php");

}
include("config.php");
function get_session()
{
	if (isset($_SESSION['userName'])) {
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
?>

<html>

<head>
	<title>Catalogue [Invite]</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grossiste3D [Invite]</title>
</head>

<h2 id=filtre>🔎 Toutes les statistiques du site 🔍</h2>
<div class="box">
	<form method="post" action="stat_liste_user.php">
		<div class="col">
			<div class=formulaire>
			<input type="submit" value="Liste utilisateur" name="userlist">
				
			</div>
		</div>
	</form>
</div>

<h2 id=filtre>Nombre d'utilisateurs =
<?php
	$sql = 'SELECT COUNT(*) as "nbuser" FROM utilisateur';
	$result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
	echo $result['nbuser'];
?>
</h2>

<h2 id=filtre>Nombre d'accessoires =
<?php
	$sql2 = 'SELECT COUNT(*) as "nbaccessory" FROM accessory';
	$result2 = mysqli_fetch_assoc(mysqli_query($conn, $sql2));
	echo $result2['nbaccessory'];
?>
</h2>

<h2 id=filtre>Nombre de machines =
<?php
	$sql3 = 'SELECT COUNT(*) as "nbmachine" FROM machine';
	$result3 = mysqli_fetch_assoc(mysqli_query($conn, $sql3));
	echo $result3['nbmachine'];
?>
</h2>

<h2 id=filtre>Nombre de filaments =
<?php
	$sql4 = 'SELECT COUNT(*) as "nbfilament" FROM filament';
	$result4 = mysqli_fetch_assoc(mysqli_query($conn, $sql4));
	echo $result4['nbfilament'];
?>
</h2>
</body>

</html>