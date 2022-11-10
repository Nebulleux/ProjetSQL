<?php 
include("../status/connected.php");
include("header_op.php"); 
include("../config.php");
include("configCSS_adm.html");
?>

<html>
<head>
<title>Catalogue</title>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grossiste3D [Admin]</title>
</head>

<br>
<?php //<img class="gif" src="bg.gif">?>
<h2 id=filtre>🔎 Filtrer les produits 🔍</h2>

<form method="post">
<div id=formulaire>
	<div>
		<label for="price">💸 Prix minimum : </label>
		<input type="price" id="min" name="price_min"> €
	</div>
	<div>
		<label for="price">💳 Prix maximum :</label>
		<input type="price" id="max" name="price_max"> €
	</div>

	<div>
		<label for="bobine">🧵 Bobines  </label>
		<input type="checkbox" id="bobine" name="bobine">
	</div>
	<div>
		<label for="machine">📠 Machines</label>
		<input type="checkbox" id="machine" name="machine">
	</div>
	<br>
	<input type="submit" value="Trier">
	<input type="reset" value="Effacer les champs">
</div>
</form>


<h2>🛒 Articles Disponibles 🛒</h2>
<table>
<tr>
<th>image</th>
<th>catégorie</th>
<th>libellé</th>
<th>description</th>
<th>prix TTC</th>
<th>suppression</th>
<th>modification</th>
</tr>

<?php
function grande_fonction($value,$prixminentre,$prixmaxentre,$foo) {
	if (!empty($prixminentre) && !empty($prixmaxentre)) {
	
			if ((($value['prix_HT']*1.2) > $prixminentre) && (($value['prix_HT']*1.2) < $prixmaxentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'NA'."</td>" : "<td>".'<img class="fit-picture"'."src=".$value['image'].">"."</td>";
				echo "<td>".$value['catégorie']."</td>";
				echo "<td>".$value['libellé']."</td>";
				echo "<td>".$value['description']."</td>";
				echo (empty($value['prix_HT'])) ? "<td>".'NA'."</td>" : "<td>".($value['prix_HT']*1.2)."</td>";
				echo "<td><a href='main.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}
	if (!empty($prixminentre) && empty($prixmaxentre)) {
	
			if ((($value['prix_HT']*1.2) > $prixminentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'NA'."</td>" : "<td>".'<img class="fit-picture"'."src=".$value['image'].">"."</td>";
				echo "<td>".$value['catégorie']."</td>";
				echo "<td>".$value['libellé']."</td>";
				echo "<td>".$value['description']."</td>";
				echo (empty($value['prix_HT'])) ? "<td>".'NA'."</td>" : "<td>".($value['prix_HT']*1.2)."</td>";
				echo "<td><a href='main.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}
	
	if (empty($prixminentre) && !empty($prixmaxentre)) {
	
			if ((($value['prix_HT']*1.2) < $prixmaxentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'NA'."</td>" : "<td>".'<img class="fit-picture"'."src=".$value['image'].">"."</td>";
				echo "<td>".$value['catégorie']."</td>";
				echo "<td>".$value['libellé']."</td>";
				echo "<td>".$value['description']."</td>";
				echo (empty($value['prix_HT'])) ? "<td>".'NA'."</td>" : "<td>".($value['prix_HT']*1.2)."</td>";
				echo "<td><a href='main.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}

	if (empty($prixminentre) && empty($prixmaxentre)) {
			echo (empty($value['image'])) ? "<td>".'NA'."</td>" : "<td>".'<img class="fit-picture"'."src=".$value['image'].">"."</td>";
			echo "<td>".$value['catégorie']."</td>";
			echo "<td>".$value['libellé']."</td>";
			echo "<td>".$value['description']."</td>";
			echo (empty($value['prix_HT'])) ? "<td>".'NA'."</td>" : "<td>".($value['prix_HT']*1.2)."</td>";
			echo "<td><a href='main.php?delete=".$value['id']."' class='delete'>❌</a></td>";
			echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
			$foo = true;
	}
}
$foo = false;
$connectaumax = $conn->query("SELECT * FROM product");
foreach ($connectaumax as $value){
$foo = false;
?>

<tr id=line onclick="document.location = 'produit_op.php?id=<?= $value['id'] ?>'">

<?php
if (!empty($_POST) && isset($_POST['price_min']) && isset($_POST['price_max']) ) {
	$prixminentre = $_POST['price_min'];
	$prixmaxentre = $_POST['price_max'];
} else {
	$prixminentre=0;
	$prixmaxentre=PHP_INT_MAX;
}
?>

<?php
//==============================================================================
if (!empty($_POST['bobine'])) {
    if ($value['catégorie']=="bobine") {
			grande_fonction($value,$prixminentre,$prixmaxentre,$foo);
    }
}
?>

<?php
if (!empty($_POST['machine'])) {
    if ($value['catégorie']=="machine") {
			grande_fonction($value,$prixminentre,$prixmaxentre,$foo);
    }
}
?>

<?php
if (empty($_POST['bobine']) && empty($_POST['machine'])) {
	grande_fonction($value,$prixminentre,$prixmaxentre,$foo);
}
echo "</tr>";
}

if (isset($_GET['delete'])){
    $del = "DELETE FROM product WHERE id=".$_GET['delete'];
    $conn->query($del);
    header('Location:main.php');
}
?>

</table>
</body>
</html>
