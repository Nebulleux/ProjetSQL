<?php
include("status/idle.php");
include("header.php");
include("config.php");
include("configCSS.html");
?>
<html>

<head>
	<title>Catalogue [Invite]</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grossiste3D [Invite]</title>
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico"> <!-- Voir pk ca marche pas ???-->
</head>

<br>

<div class="first">
	<h2 id=filtre>🔎 Filtrer les produits 🔍</h2>

	<div class="box">
		<form method="post">
			<div class="col">
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
			</div>
		</form>
		<div class="col">
			<img class="gif" src="assets/bg.gif">
		</div>
	</div>
</div>


<h2>🛒 Articles Disponibles 🛒</h2>
<table>
	<tr>
		<th>Image</th>
		<th>Libellé</th>
		<th>Description</th>
		<th>Prix TTC</th>
		<th>Notation</th>
		<th>Un avis ? 🤔</th>
	</tr>

	<?php

function grande_fonction($value, $prixminentre, $prixmaxentre, $foo)
{
	include("config.php");
	$sql2 = 'SELECT CAST(AVG(rating.rate) AS DECIMAL(5, 1)) as MOY FROM rating,product WHERE rating.idProduct =' . $value['id'];
	$resultat = $conn->query($sql2);

	if (!empty($prixminentre) && !empty($prixmaxentre)) {

		if ((($value['price'] * 1.2) > $prixminentre) && (($value['price'] * 1.2) < $prixmaxentre) && ($foo == false)) {
			echo (empty($value['image'])) ? "<td>" . '<img class="fit-picture"' . "src=assets/no_image.jpg" . ">" . "</td>" : "<td>" . '<img class="fit-picture"' . "src=" . $value['image'] . ">" . "</td>";
			echo (empty($value['name'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['name']) . "</td>";
			echo (empty($value['description'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['description']) . "</td>";
			echo (empty($value['price'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['price'] * 1.2) . "</td>";
			while ($ligne = mysqli_fetch_array($resultat)) {
				echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
			}
			$foo = true;
		}
	}
	if (!empty($prixminentre) && empty($prixmaxentre)) {

		if ((($value['price'] * 1.2) > $prixminentre) && ($foo == false)) {
			echo (empty($value['image'])) ? "<td>" . '<img class="fit-picture"' . "src=assets/no_image.jpg" . ">" . "</td>" : "<td>" . '<img class="fit-picture"' . "src=" . $value['image'] . ">" . "</td>";
			echo (empty($value['name'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['name']) . "</td>";
			echo (empty($value['description'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['description']) . "</td>";
			echo (empty($value['price'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['price'] * 1.2) . "</td>";
			while ($ligne = mysqli_fetch_array($resultat)) {
				echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
			}
			$foo = true;
		}
	}

	if (empty($prixminentre) && !empty($prixmaxentre)) {

		if ((($value['price'] * 1.2) < $prixmaxentre) && ($foo == false)) {
			echo (empty($value['image'])) ? "<td>" . '<img class="fit-picture"' . "src=assets/no_image.jpg" . ">" . "</td>" : "<td>" . '<img class="fit-picture"' . "src=" . $value['image'] . ">" . "</td>";
			echo (empty($value['name'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['name']) . "</td>";
			echo (empty($value['description'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['description']) . "</td>";
			echo (empty($value['price'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['price'] * 1.2) . "</td>";
			while ($ligne = mysqli_fetch_array($resultat)) {
				echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
			}
			$foo = true;
		}
	}

	if (empty($prixminentre) && empty($prixmaxentre)) {
		echo (empty($value['image'])) ? "<td>" . '<img class="fit-picture"' . "src=assets/no_image.jpg" . ">" . "</td>" : "<td>" . '<img class="fit-picture"' . "src=" . $value['image'] . ">" . "</td>";
		echo (empty($value['name'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['name']) . "</td>";
		echo (empty($value['description'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['description']) . "</td>";
		echo (empty($value['price'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['price'] * 1.2) . "</td>";
		while ($ligne = mysqli_fetch_array($resultat)) {
			echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
		}
		$foo = true;
	}
}
$foo = false;
$connectaumax = $conn->query("SELECT * FROM product");
foreach ($connectaumax as $value) {
	$foo = false;
?>

	<tr id=line onclick="document.location = 'produit.php?id=<?= $value['id'] ?>'">

		<?php
	if (!empty($_POST) && isset($_POST['price_min']) && isset($_POST['price_max'])) {
		$prixminentre = $_POST['price_min'];
		$prixmaxentre = $_POST['price_max'];
	} else {
		$prixminentre = 0;
		$prixmaxentre = PHP_INT_MAX;
	}
?>

		<?php
	//==============================================================================
	if (!empty($_POST['bobine'])) {
		if ($value['catégorie'] == "bobine") {
			grande_fonction($value, $prixminentre, $prixmaxentre, $foo);
		}
	}
?>


		<?php
	if (!empty($_POST['machine'])) {
		if ($value['catégorie'] == "machine") {
			grande_fonction($value, $prixminentre, $prixmaxentre, $foo);
		}
	}
?>


		<?php
	if (empty($_POST['bobine']) && empty($_POST['machine'])) {
		grande_fonction($value, $prixminentre, $prixmaxentre, $foo);
	}
	echo "</tr>";
}


if (isset($_GET['delete'])) {
	$del = "DELETE FROM product WHERE id=" . $_GET['delete'];
	$conn->query($del);
	header('Location: main.php');
}
?>

</table>
</body>

</html>