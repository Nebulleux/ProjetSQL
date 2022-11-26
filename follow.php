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
<table>
		<tr>
            <th>Image</th>
            <th>Id Utilisateur</th>
			<th>Utilisateur</th>
		</tr>
		<?php
        //get id of connected user
        $sql7 = 'SELECT DISTINCT utilisateur.id as idUser FROM utilisateur,product,rating WHERE utilisateur.username ="'.$_SESSION["log"].'"';
        $review_query7 = mysqli_query($conn, $sql7);
        $result = mysqli_fetch_assoc($review_query7);
        $actualuserid = $result['idUser'];

        //show only followed users
        $sql = 'SELECT DISTINCT utilisateur.id as "userid", utilisateur.username as "user", utilisateur.image as "image" FROM utilisateur,follow WHERE utilisateur.id = follow.idFollowed AND follow.idFollower ='.$actualuserid;
        $connect3 = $conn->query($sql);

		while ($row3 = $connect3->fetch_assoc()) {
            $b = $row3['userid'];

            echo '<form id="checkfollow" action="follow.php?idfollowed='.$b.'" method="post" name=thisform>';
            echo (empty($row3['image'])) ? '<td> <img src="assets/no_pp.png" width="100" height="100" alt="User Image"/> </td>' : '<td> <img src="'.$row3['image'].'" width="100" height="100" alt="User Image"/> </td>' ;
            echo (empty($row3['userid'])) ? "<td> NA </td>" : "<td>" . $row3['userid'] . "</td>";
	        echo (empty($row3['user'])) ? "<td> NA </td>" : "<td>" . $row3['user'] . "</td>";
            echo '<td>';
			echo '<input type="submit" name="❌" id = "❌" value="❌">';
			echo '</td>';

	        echo "<tr>";
            echo '</form>';
        }

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
                header("Location: follow.php");
				?>
				<div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous ne suivez plus l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?> </div>
				<?php
			} else {
				?>
  					<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Vous ne suivez pas l'utilisateur n°<?php echo $_SESSION["followed"].' : '.$_SESSION['followeduserid'] ?></div>
  				<?php
			}
		}
        ?>
</body>
</html>