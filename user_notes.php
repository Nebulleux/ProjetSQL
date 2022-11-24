<?php 
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();

if(isset($_SESSION['userName'])) {
	echo "Your session is running " . $_SESSION['userName'];
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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Notations utilisateur</title>

</head>

<body>
<table>
		<tr>
			<th>Image</th>
			<th>Date</th>
			<th>Utilisateur</th>
			<th>Note</th>
			<th>Commentaire</th>
		</tr>
		<?php

        $test = $_SESSION["log"];
        $sql4 = 'SELECT DISTINCT rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" FROM utilisateur,rating,product WHERE utilisateur.id = rating.idUser AND utilisateur.username ="'.$test.'"';
        $connect2 = $conn->query($sql4);
        
        while ($row2 = $connect2->fetch_assoc()) {
            echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
	        echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
	        echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
	        echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
	        echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
	        echo "<tr>";
        }
        ?>
</body>

</html>