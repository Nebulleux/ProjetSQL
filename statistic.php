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

<?php 
$sqlgraph = 'SELECT CONCAT(UNIX_TIMESTAMP(rating.dateOfPub),"000") as "date", rating.rate as "rat" FROM rating' ;
$resultarray = array();
if ($result = mysqli_query($conn, $sqlgraph)) {
	while ($rowa = mysqli_fetch_row($result)) {
		$resultarray[] = $rowa;    
	}
	$data = '{"user_notes":'.json_encode($resultarray, JSON_NUMERIC_CHECK).'}';
}

file_put_contents("assets/data.json", "");
$file = 'assets/data.json';
file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

?>
<script>
window.onload = function() {
 
var dataPoints = [];
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "dark2",
	zoomEnabled: true,
	title: {
		text: "Avis utilisateurs sur tous les produits du site"
	},
	axisY: {
		title: "Notes utilisateurs",
		titleFontSize: 24,
		prefix: ""
	},
	data: [{
		type: "scatter",
		yValueFormatString: "#,##0.00",
		dataPoints: dataPoints,
		markerType: "circle",
		markerSize: 20
	}]
});
 

function addData(data) {
	var dps = data.user_notes;
	for (var i = 0; i < dps.length; i++) {
		dataPoints.push({
			x: new Date(dps[i][0]),
			y: dps[i][1]
		});
	}
	chart.render();
}

$.getJSON("assets/data.json", addData);
 
}
</script>

</head>

<body>



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

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>

</html>