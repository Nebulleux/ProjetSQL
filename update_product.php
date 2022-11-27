<?php
session_start();
$_SESSION["group"] = get_session();
if(isset($_SESSION['userName'])) {
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
function get_session() {
	if(isset($_SESSION['userName'])) {
	  return $_SESSION['userName'];
	} else {
	  return '';
	}
  }
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Modification d'un produit</title>
</head>

<body>
	<?php $idget = ($_GET["id"]); ?>
	<?php echo "<h2>📝 Modification du produit n°" . $idget . "📝</h2>" ?>

	<?php
    $connectaumax = $conn->query("SELECT * FROM product WHERE id = " . $idget);
    while ($row = $connectaumax->fetch_assoc()) {
	    $nam = $row['name'];
	    $des = $row['description'];
	    $pri = $row['price'];
	    $rat = $row['rating'];

	    echo '<form action="update_product.php?id="' . $idget . '" class="formulaire2" method="POST">';

	    echo 'Libellé : <br>';
	    echo '<input type="text" name="label" value="' . $nam . '" required> <br>';

	    echo 'Description : <br>';
	    echo '<textarea name="description" required>' . $des . '</textarea> <br><br>';

	    echo 'Prix : <br>';
	    echo '<input type="text" name="prix" value="' . $pri . '" required> <br>';
    }
    ?>
	<input type="submit" value="Insérer">

	<input type="button" onclick="location.href='./main.php';" value="Retour liste" />
	</form>

	<?php
    if (!empty($_POST)) {
	    $sql = "UPDATE product SET catégorie='" . $_POST['category'] . "', libellé='" . $_POST['label'] . "', description='" . $_POST['description'] . "', poids='" . $_POST['poids'] . "', couleur='" . $_POST['couleur'] . "', dimensions='" . $_POST['dimensions'] . "', diamètre_filament='" . $_POST['diamètre_filament'] . "', précision='" . $_POST['précision'] . "', temperature_transi_vitreuse='" . $_POST['temperature_transi_vitreuse'] . "', temperature_point_de_fusion='" . $_POST['temperature_point_de_fusion'] . "', prix_HT=" . $_POST['prix_HT'] . ", image='" . $_POST['image'] . "' WHERE id=" . $_GET['id'];
	    if (mysqli_query($conn, $sql)) {
		    echo "Produit modifié avec succès";
	    } else {
		    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	    }
    }
    ?>




</body>

</html>