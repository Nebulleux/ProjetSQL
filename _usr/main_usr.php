<?php 
include("../status/idle.php");
include("header.php"); 
?>
<html>
<head>
<title>Catalogue</title>

<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Grossiste3D [Invite]</title>
	<link rel="icon" type="image/x-icon" href="../assets/icon.ico">
	<link rel="stylesheet" href="assets/style.css">
	<link rel="stylesheet" href="assets/header-login-signup.css">

</head>

<br>

<div class="first">
<h2 id=filtre>🔎 Filtrer les produits 🔍</h2>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "jbropp_01";
    $conn = mysqli_connect($servername, $username, $password,$db);
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }
//error_reporting(0);
//ini_set('display_errors', 0);
?>

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
</div>

<?php //<img class="gif" src="assets/bg.gif"> ?>

<h2>🛒 Articles Disponibles 🛒</h2>
<table>
<tr>
<th>image</th>
<th>catégorie</th>
<th>libellé</th>
<th>description</th>
<th>prix TTC</th>
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
				$foo = true;
			}
	}

	if (empty($prixminentre) && empty($prixmaxentre)) {
			echo (empty($value['image'])) ? "<td>".'NA'."</td>" : "<td>".'<img class="fit-picture"'."src=".$value['image'].">"."</td>";
			echo "<td>".$value['catégorie']."</td>";
			echo "<td>".$value['libellé']."</td>";
			echo "<td>".$value['description']."</td>";
			echo (empty($value['prix_HT'])) ? "<td>".'NA'."</td>" : "<td>".($value['prix_HT']*1.2)."</td>";
			$foo = true;
	}
}
$foo = false;
$connectaumax = $conn->query("SELECT * FROM product");
foreach ($connectaumax as $value){
$foo = false;
?>

<tr id=line onclick="document.location = 'produit.php?id=<?= $value['id'] ?>'">

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
    header('Location: main.php');
}
?>

</table>
</body>
</html>
