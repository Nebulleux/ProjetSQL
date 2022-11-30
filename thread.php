<?php 
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
$_SESSION["followed"] = get_followed();

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

  function get_followed() {
	if(isset($_GET["idfollowed"])) {
	  return $_GET["idfollowed"];
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
<table style="width:70%">

<col>
		<tr>
			<th>Id commentaire</th>
            <th>Référence produit</th>
            <th>Image produit</th>
			<th>Image</th>
			<th>Date</th>
            <th>Id Utilisateur</th>
			<th>Utilisateur</th>
			<th>Note</th>
			<th>Commentaire</th>
            <th>Suivre</th>
		</tr>
		<?php

        $test = $_SESSION["log"];
        $sql4 = 'SELECT DISTINCT rating.id as "ratingid", utilisateur.id as "userid",product.image as "refimage", product.name as "nom", rating.dateOfPub as "date",utilisateur.username as "user", utilisateur.image as image, rating.rate as "rate",rating.comm as "comm" FROM utilisateur,rating,product WHERE product.id = rating.idProduct AND utilisateur.id = rating.idUser ORDER BY date DESC';
        $connect2 = $conn->query($sql4);
        


		while ($row2 = $connect2->fetch_assoc()) {
			$b = $row2['userid'];
			$c = $row2['ratingid'];
			echo '<form id="checkfollow" action="thread.php?idfollowed='.$b.'" method="post" name=thisform'.$c.'>';
			echo (empty($row2['ratingid'])) ? "<td> NA </td>" : "<td>" . $row2['ratingid'] . "</td>";
            echo (empty($row2['nom'])) ? "<td> NA </td>" : "<td>" . $row2['nom'] . "</td>";
            echo (empty($row2['refimage'])) ? '<td> <img src="assets/no_image.png" class="fit-picture" alt="User Image"/> </td>' : '<td> <img src="'.$row2['refimage'].'" class="fit-picture" alt="User Image"/> </td>' ;
            echo (empty($row2['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row2['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
	        echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
            echo (empty($row2['userid'])) ? "<td> NA </td>" : "<td>" . $row2['userid'] . "</td>";
	        echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
	        echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
	        echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
            echo '<td>';
			echo '<input type="submit" name="✅" id = "✅" value="✅">';
			echo '<input type="submit" name="❌" id = "❌" value="❌">';

			echo '</td>';

	        echo "<tr>";
			echo '</form>';

        }
        ?>

		<?php
	//get id of connected user
	$sql7 = 'SELECT DISTINCT utilisateur.id as idUser FROM utilisateur,product,rating WHERE utilisateur.username ="'.$_SESSION["log"].'"';
	$review_query7 = mysqli_query($conn, $sql7);
	$result = mysqli_fetch_assoc($review_query7);
	$actualuserid = (!empty($result['idUser']));

		if (isset($_POST['❌'])) {
			//get name of user from id
			$sql10 = 'SELECT DISTINCT utilisateur.username as usrname FROM utilisateur WHERE utilisateur.id='.$_SESSION["followed"];
			$review_query10 = mysqli_query($conn, $sql10);
			$result = mysqli_fetch_assoc($review_query10);
			$followeduserid = $result['usrname'];
			$_SESSION['followeduserid'] = $followeduserid;

			//check for existing followed follower association
			$sql8 = "SELECT DISTINCT follow.idFollower,follow.idFollowed FROM follow,utilisateur WHERE follow.idFollower = $actualuserid AND follow.idFollowed = ".$_SESSION["followed"] ;
			$follow_query = mysqli_query($conn, $sql8);
			$check_user = mysqli_num_rows($follow_query);

			if ($check_user == 1) {
				//delete values
				$sql9 = 'DELETE FROM follow WHERE idFollower='.$actualuserid.' AND idFollowed='.$_SESSION["followed"]; 
				$insertquery = mysqli_query($conn, $sql9);
				?>
				<div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous ne suivez plus l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?> </div>
				<?php
			} else {
				?>
  					<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous ne suivez pas l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?></div>
  				<?php
			}
		}

		if (isset($_POST['✅'])) {
			//get name of user from id
			$sql10 = 'SELECT DISTINCT utilisateur.username as usrname FROM utilisateur WHERE utilisateur.id='.$_SESSION["followed"];
			$review_query10 = mysqli_query($conn, $sql10);
			$result = mysqli_fetch_assoc($review_query10);
			$followeduserid = $result['usrname'];
			$_SESSION['followeduserid'] = $followeduserid;

			//check for duplicate followed follower association
			$sql5 = "SELECT DISTINCT follow.idFollower,follow.idFollowed FROM follow,utilisateur WHERE follow.idFollower = $actualuserid AND follow.idFollowed = ".$_SESSION["followed"] ;
			$follow_query = mysqli_query($conn, $sql5);
            $check_user = mysqli_num_rows($follow_query);
			
			if ($check_user == 0) {
				//insert values
				$sql6 = 'INSERT INTO follow (idFollower, idFollowed) VALUES ('.$actualuserid.','.$_SESSION["followed"].')'; 
				$insertquery = mysqli_query($conn, $sql6);
				?>
				<div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous suivez maintenant l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?></div>
				<?php
			} else {
				?>
  					<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous suivez déjà l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?></div>
  				<?php
			}
		}
		?>

</body>
</html>