<?php 
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();

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
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Notations utilisateur</title>

</head>

<body>
<h2 id=filtre>🔎 Voir vos appréciations 🔍</h2>
<div class="box">
	<form method="post">
		<div class="col">
			<div class=formulaire>
				<div>
					<label for="desc_rate">Trier par vos notes (Meilleure à la moins bonne) : </label>
                    <input type="submit" name="desc_rate_user" id = "desc_rate_user" value="Go">
				</div>

                <div>
					<label for="price">Trier par vos notes (Moins bonne à la meilleure) : </label>
                    <input type="submit" name="asc_rate_user" id = "asc_rate_user" value="Go">
				</div>
  					<br>
                <div>
					<label for="price">Trier par moyenne du site (Meilleure à la moins bonne) : </label>
                    <input type="submit" name="desc_rate_moy" id = "desc_rate_moy" value="Go">
				</div>

                <div>
					<label for="price">Trier par moyenne du site (Moins bonne à la meilleure) : </label>
                    <input type="submit" name="asc_rate_moy" id = "asc_rate_moy" value="Go">
				</div>
			</div>
		</div>
	</form>
</div>
<table>
		<tr>
            <th>Référence produit</th>
			<th>Image</th>
			<th>Date</th>
			<th>Utilisateur</th>
			<th>Note</th>
			<th>Commentaire</th>
		</tr>
		<?php

        $test = $_SESSION["log"];

        $sql1 = 'SELECT DISTINCT product.name as "nom", rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" 
		FROM utilisateur,rating,product WHERE product.id = rating.idProduct AND utilisateur.id = rating.idUser AND utilisateur.username ="'.$test.'"'.' ORDER BY rate DESC' ;

		$sql2 = 'SELECT DISTINCT product.name as "nom", rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" 
		FROM utilisateur,rating,product WHERE product.id = rating.idProduct AND utilisateur.id = rating.idUser AND utilisateur.username ="'.$test.'"'.' ORDER BY rate ASC' ;

        $sql3 = 'SELECT DISTINCT (SELECT AVG(rating.rate) FROM rating,product WHERE product.id = rating.idProduct) as "allrate", product.name as "nom", rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" 
		FROM utilisateur,rating,product 
		WHERE product.id = rating.idProduct AND utilisateur.id = rating.idUser AND utilisateur.username = "'.$test.'" ORDER BY allrate ASC' ;

        $sql4 = 'SELECT DISTINCT (SELECT AVG(rating.rate) FROM rating,product WHERE product.id = rating.idProduct) as "allrate", product.name as "nom", rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" 
		FROM utilisateur,rating,product 
		WHERE product.id = rating.idProduct AND utilisateur.id = rating.idUser AND utilisateur.username = "'.$test.'" ORDER BY allrate ASC' ;
		        
		if (isset($_POST['desc_rate_user'])) {
			$connect1 = $conn->query($sql1);
			while ($row2 = $connect1->fetch_assoc()) {
				echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
				echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
				echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
				echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
				echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
				echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
				echo "<tr>";
			}
		} else if (isset($_POST['asc_rate_user'])) {
			$connect2 = $conn->query($sql2);
			while ($row2 = $connect2->fetch_assoc()) {
				echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
				echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
				echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
				echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
				echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
				echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
				echo "<tr>";
			}
		} else if (isset($_POST['desc_rate_moy'])) {
			$connect3 = $conn->query($sql3);
			while ($row2 = $connect3->fetch_assoc()) {
				echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
				echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
				echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
				echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
				echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
				echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
				
				echo "<tr>";
			}
		} else if (isset($_POST['asc_rate_moy'])) {
			$connect4 = $conn->query($sql4);
			while ($row2 = $connect4->fetch_assoc()) {
				echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
				echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
				echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
				echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
				echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
				echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
				echo "<tr>";
			}
		} else {
			$connect1 = $conn->query($sql1);
			while ($row2 = $connect1->fetch_assoc()) {
				echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
				echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
				echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
				echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
				echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
				echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
				echo "<tr>";
			}
		}


        ?>
</body>

</html>