<?php
sess
include("configCSS_adm.html");
ion_start();
$_SESSION["group"] = get_session();
if(isset($_SESSION['userName'])) {
	echo "Your session is running " . $_SESSION['userName'];
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {
		include("header_op.php");
		include("configCSS_adm.html");
	} else if ($_SESSION['userName'] == 'Root') {
		include("header_op.php");
		
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
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Insertion d'un produit</title>
</head>

<body>
  <h2>📥 Ajouter un nouvel article 📥</h2>
  <form action="insert_product.php" class="centre" method="POST">
    Catégorie : <br>
    <input type="text" name="category"> <br>

    Libellé : <br>
    <input type="text" name="label"> <br>

    Description : <br>
    <textarea name="description"></textarea> <br><br>

    Poids : <br>
    <input type="text" name="poids"> <br>

    Couleur : <br>
    <input type="text" name="couleur"> <br>

    Dimensions : <br>
    <input type="text" name="dimensions"> <br>

    Diamètre du filament : <br>
    <input type="text" name="diamètre_filament"> <br>

    Prix HT : <br>
    <input type="text" name="prix_HT"> <br>

    Précision : <br>
    <input type="text" name="précision"> <br>

    Température de transition vitreuse : <br>
    <input type="text" name="temperature_transi_vitreuse"> <br>

    Température de point de fusion : <br>
    <input type="text" name="temperature_point_de_fusion"> <br>

    Image : <br>
    <input type="text" name="image"> <br>

    <input type="submit" value="Insérer">

    <input type="button" onclick="location.href='./main.php';" value="Retour liste" />
  </form>


  <?php
  if (!empty($_POST['category']) && (!empty($_POST['label'])) && !empty($_POST['description']) && !empty($_POST['poids']) && !empty($_POST['couleur']) && !empty($_POST['dimensions']) && !empty($_POST['diamètre_filament']) && !empty($_POST['prix_HT']) && !empty($_POST['précision']) && !empty($_POST['temperature_transi_vitreuse']) && !empty($_POST['temperature_point_de_fusion'])) {
    $sql = "INSERT INTO product (catégorie, libellé, description, poids, couleur, dimensions, diamètre_filament, précision, temperature_transi_vitreuse, temperature_point_de_fusion, prix_HT, image) VALUES ('" . $_POST['category'] . "', '" . $_POST['label'] . "', '" . $_POST['description'] . "' , '" . $_POST['poids'] . "' , '" . $_POST['couleur'] . "' , '" . $_POST['dimensions'] . "' , '" . $_POST['diamètre_filament'] . "' , '" . $_POST['précision'] . "' , '" . $_POST['temperature_transi_vitreuse'] . "' , '" . $_POST['temperature_point_de_fusion'] . "', '" . $_POST['prix_HT'] . "' , '" . $_POST['image'] . "')";
    if (mysqli_query($conn, $sql)) {
      echo "Produit ajouté avec succès";
    } else {
      echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
    }
  }

  if (empty($_POST['category'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Catégorie manquante !</div>';
  }
  if (empty($_POST['label'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Label manquant !</div>';
  }
  if (empty($_POST['description'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Description manquante !</div>';
  }
  if (empty($_POST['poids'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Poids manquant !</div>';
  }
  if (empty($_POST['couleur'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Couleur manquante !</div>';
  }
  if (empty($_POST['dimensions'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Dimensions manquantes !</div>';
  }
  if (empty($_POST['diamètre_filament'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Diamètre manquant !	</div>';
  }
  if (empty($_POST['prix_HT'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Prix hors taxe manquant !	</div>';
  }
  if (empty($_POST['précision'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Précision manquante !</div>';
  }
  if (empty($_POST['temperature_transi_vitreuse'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Temp transi vitreuse manquante !</div>';
  }
  if (empty($_POST['temperature_point_de_fusion'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Temp au point de fusion manquante !</div>';
  }
  if (empty($_POST['image'])) {
    echo '<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display="none";">&times;</span>Image manquante.</div>';
  }


  ?>




</body>

</html>