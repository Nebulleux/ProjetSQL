<?php 
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
$_SESSION["useracc"] = get_useracc();

if(isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {
		include("header_op.php");
		include("configCSS_adm.html");
	} else if ($_SESSION['userName'] == 'Root') {
		include("header_op.php");
		include("configCSS_adm.html");
	} else {
		include("header.php");
		include("configCSS.html");
	}
  } else {
	include("header.php");
	include("configCSS.html");
  }
include("config.php");
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
  function get_useracc() {
	if(isset($_GET["id"])) {
	  return $_GET["id"];
	} else {
	  return '';
	}
  }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Notations utilisateur</title>

</head>

<body>
<div class="box">
	<form method="post" action="./statistic.php">
		<div class="col">
			<div class=formulaire>
			<input type="submit" value="Retour aux statistiques" name="back">
				
			</div>
		</div></div>
	</form>
</div>

<table style="width:70%">
		<tr>
			<th>User ID</th>
			<th>Image</th>
			<th>login</th>
			<th>Email</th>
			<th>Mot de passe</th>
		</tr>
		<?php
        
        $test = $_SESSION["log"];
        $sql4 = 'SELECT DISTINCT utilisateur.email as "uemail", utilisateur.password as "upwd", utilisateur.id as "userid", utilisateur.username as "user", utilisateur.image as image  FROM utilisateur';
        $connect2 = $conn->query($sql4);

        while ($row2 = $connect2->fetch_assoc()) {
            echo (empty($row2['userid'])) ? "<td> NA </td>" : "<td>" . $row2['userid'] . "</td>";
            echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
	        echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
			echo (empty($row2['uemail'])) ? "<td> NA </td>" : "<td>" . $row2['uemail'] . "</td>";
			echo (empty($row2['upwd'])) ? "<td> NA </td>" : "<td>" . $row2['upwd'] . "</td>";
	        echo "<tr>";
        }
        ?>
</body>

</html>