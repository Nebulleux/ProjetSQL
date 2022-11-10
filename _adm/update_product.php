<?php
include("../config.php");
include("configCSS_adm.html");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Modification d'un produit</title>
  </head>
  
  <body>
  <?php $idget = ($_GET["id"]); ?>
	<?php echo "<h2>📝 Modification du produit n°".$idget."📝</h2>" ?>

<?php
$connectaumax = $conn->query("SELECT * FROM product WHERE id = ".$idget);
while ($row = $connectaumax->fetch_assoc()) {
$cat=$row['catégorie'];
$lib=$row['libellé'];
$des=$row['description'];
$poi=$row['poids'];
$cou=$row['couleur'];
$dim=$row['dimensions'];
$dia=$row['diamètre_filament'];
$prh=$row['prix_HT'];
$pre=$row['précision'];
$tev=$row['temperature_transi_vitreuse'];
$tef=$row['temperature_point_de_fusion'];
$ima=$row['image'];



echo '<form action="update_product.php?id="'.$idget.'" class="centre" method="POST">"';
echo 'Catégorie : <br>';
echo '<input type="text" name="category" value="'.$cat.'"> <br>"';
        
echo 'Libellé : <br>';
echo '<input type="text" name="label" value="'.$lib.'"> <br>"';
        
echo 'Description : <br>';
echo '<textarea name="description">'.$des.'</textarea> <br><br>"';

echo 'Poids : <br>';
echo '<input type="text" name="poids" value="'.$poi.'"> <br>"';

echo 'Couleur : <br>';
echo '<input type="text" name="couleur" value="'.$cou.'"> <br>"';

echo 'Dimensions : <br>';
echo '<input type="text" name="dimensions" value="'.$dim.'"> <br>"';

echo 'Diamètre du filament : <br>';
echo '<input type="text" name="diamètre_filament" value="'.$dia.'"> <br>"';

echo 'Prix HT : <br>';
echo '<input type="text" name="prix_HT" value="'.$prh.'"> <br>"';

echo 'Précision : <br>';
echo '<input type="text" name="précision" value="'.$pre.'"> <br>"';

echo 'Température de transition vitreuse : <br>';
echo '<input type="text" name="temperature_transi_vitreuse" value="'.$tev.'"> <br>"';

echo 'Température de point de fusion : <br>';
echo '<input type="text" name="temperature_point_de_fusion" value="'.$tef.'"> <br>"';
        
echo 'Image : <br>';
echo '<input type="text" name="image" value="'.$ima.'"> <br>"';
}
?>
        <input type="submit" value="Insérer">

	<input type="button" onclick="location.href='./main.php';" value="Retour liste" />
    </form>

<?php
if (!empty($_POST)) {
//    if (!empty($_POST['category']) && (!empty($_POST['label'])) && !empty($_POST['description']) && !empty($_POST['poids']) && !empty($_POST['couleur']) && !empty($_POST['dimensions']) && !empty($_POST['diamètre_filament']) && !empty($_POST['prix_HT']) && !empty($_POST['précision']) && !empty($_POST['temperature_transi_vitreuse']) && !empty($_POST['temperature_point_de_fusion'])) {
	    $sql = "UPDATE product SET catégorie='".$_POST['category']."', libellé='".$_POST['label']."', description='".$_POST['description']."', poids='".$_POST['poids']."', couleur='".$_POST['couleur']."', dimensions='".$_POST['dimensions']."', diamètre_filament='".$_POST['diamètre_filament']."', précision='".$_POST['précision']."', temperature_transi_vitreuse='".$_POST['temperature_transi_vitreuse']."', temperature_point_de_fusion='".$_POST['temperature_point_de_fusion']."', prix_HT=".$_POST['prix_HT'].", image='".$_POST['image']."' WHERE id=".$_GET['id'];
	    if (mysqli_query($conn, $sql)) {
      		echo "Produit modifié avec succès";
	    } else {
      		echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
	    }
    }
echo "<br><br>";
if (empty($_POST['category'])) {
	echo "Catégorie manquante ! <br>";	
	}
if (empty($_POST['label'])) {
	echo "Label manquant ! <br>";	
	}
if (empty($_POST['description'])) {
	echo "Description manquante ! <br>";	
	}
if (empty($_POST['poids'])) {
	echo "Poids manquant ! <br>";	
	}
if (empty($_POST['couleur'])) {
	echo "Couleur manquante ! <br>";	
	}
if (empty($_POST['dimensions'])) {
	echo "Dimensions manquantes ! <br>";	
	}
if (empty($_POST['diamètre_filament'])) {
	echo "Diamètre manquant ! <br>";	
	}
if (empty($_POST['prix_HT'])) {
	echo "Prix hors taxe manquant ! <br>";	
	}
if (empty($_POST['précision'])) {
	echo "Précision manquante ! <br>";	
	}
if (empty($_POST['temperature_transi_vitreuse'])) {
	echo "Temp transi vitreuse manquante ! <br>";	
	}
if (empty($_POST['temperature_point_de_fusion'])) {
	echo "Temp au point de fusion manquante ! <br>";	
	}
if (empty($_POST['image'])) {
	echo "image manquante ! <br>";	
	}
//}

?>




  </body>
</html>
