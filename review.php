<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
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
	<title>Noter</title>
</head>

<body>

	<?php
    $idget = ($_GET["id"]);
    echo "<h2>Mettre un commentaire</h2><br>";
	echo "<div class=formulaire2>";
    echo "Vous êtes actuellement sur le produit n°" . $idget;
    echo "<br><br>";

    $connectaumax = $conn->query("SELECT * FROM product WHERE id = " . $idget);

    while ($row = $connectaumax->fetch_assoc()) {
		echo "<div style='display: flex;justify-content: center;'>";
	    echo (empty($row['image'])) ? '<img class="fit-picture"' . "src=assets/no_image.png" . ">" : '<img class="fit-picture"' . "src=" . $row['image'] . ">";
	    echo "<br><br>";

	    echo "Libellé: ";
	    echo $row['name'];
	    echo "<br>";

	    echo "Catégorie: ";
	    echo $row['description'];
	    echo "<br>";

	    echo "Prix TTC: ";
	    echo $row['price'] * 1.2;
	    echo "<br>";

	    echo "Prix sans TVA: ";
	    echo $row['price'];
	    echo "<br>";
		
    }
    echo "Moyenne des notes: ";
    $sql2 = 'SELECT CAST(AVG(rating.rate) AS DECIMAL(5, 2)) as MOY FROM rating,product WHERE rating.idProduct =' . $idget;
    $resultat = $conn->query($sql2);
    while ($ligne = mysqli_fetch_array($resultat)) {
	    echo (empty($ligne['MOY'])) ? "0/5" : $ligne['MOY'] . "/5";
    }
	echo "</div>";
    echo "<br><br>";
    ?>

		<form action="main.php" class="form-container" method="POST">
			Note : <br>
			<input style="width:500px;" type="number" step="0.1" min="0" max="5" name="note" placeholder="Veuillez entrez une note de 0 à 5" required> <br>

			Commentaire : <br>
			<textarea style="width:500px;" type="text" name="comment" placeholder="Veuillez entrez votre commentaire sur ce produit" required ></textarea> <br>

			<input type="submit" name="review_submit" value="Envoyer">
		</form>

<?php
if (!empty($_POST['note']) && (!empty($_POST['comment']))) {

    $review_submit = ($_POST['review_submit']);
	
    if ($review_submit) {
		//get id of connected user
		$sql7 = 'SELECT DISTINCT utilisateur.id as idUser FROM utilisateur WHERE utilisateur.username ="'.$_SESSION["log"].'"';
		$review_query7 = mysqli_query($conn, $sql7);
		$result = mysqli_fetch_assoc($review_query7);
		$actualuserid = $result['idUser'];

		$n = $_POST['note'];
		$c = $_POST['comment'];
		$i = $actualuserid;
		$p = $idget;
		$sql4 = 'INSERT INTO rating (rate, comm, idUser, idProduct) VALUES ('.$n.',"'.$c.'",'.$i.",".$p.')';
		mysqli_query($conn, $sql4);
	}
}
		?>
	</div>
</body>

</html>