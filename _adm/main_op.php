<?php 
include("../status/connected.php");
include("header_op.php"); 
include("../config.php");
include("configCSS_adm.html");
?>

<html>
<head>
<title>Catalogue [Admin]</title>
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
<th>Image</th>
<th>Libellé</th>
<th>Description</th>
<th>Prix TTC</th>
<th>Notation</th>
</tr>

<?php
function grande_fonction($value,$priceminentre,$pricemaxentre,$foo) {
	include("../config.php"); 
	$sql2 = 'SELECT CAST(AVG(rating.rate) AS DECIMAL(5, 1)) as MOY FROM rating,product WHERE rating.idProduct ='.$value['id'];
	$resultat= $conn->query($sql2);

	if (!empty($priceminentre) && !empty($pricemaxentre)) {
	
			if ((($value['price']*1.2) > $priceminentre) && (($value['price']*1.2) < $pricemaxentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'<img class="fit-picture"'."src=../assets/no_image.jpg".">"."</td>" : "<td>".'<img class="fit-picture"'."src=../".$value['image'].">"."</td>";
				echo (empty($value['name'])) ? "<td>".'NA'."</td>" : "<td>".($value['name'])."</td>";
				echo (empty($value['description'])) ? "<td>".'NA'."</td>" : "<td>".($value['description'])."</td>";
				echo (empty($value['price'])) ? "<td>".'NA'."</td>" : "<td>".($value['price']*1.2)."</td>";
				while($ligne=mysqli_fetch_array($resultat)){
					echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
				}
				echo "<td><a href='main_op.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}
	if (!empty($priceminentre) && empty($pricemaxentre)) {
	
			if ((($value['price']*1.2) > $priceminentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'<img class="fit-picture"'."src=../assets/no_image.jpg".">"."</td>" : "<td>".'<img class="fit-picture"'."src=../".$value['image'].">"."</td>";				echo (empty($value['name'])) ? "<td>".'NA'."</td>" : "<td>".($value['name'])."</td>";
				echo (empty($value['description'])) ? "<td>".'NA'."</td>" : "<td>".($value['description'])."</td>";
				echo (empty($value['price'])) ? "<td>".'NA'."</td>" : "<td>".($value['price']*1.2)."</td>";
				while($ligne=mysqli_fetch_array($resultat)){
					echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
				}
				echo "<td><a href='main_op.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}
	
	if (empty($priceminentre) && !empty($pricemaxentre)) {
	
			if ((($value['price']*1.2) < $pricemaxentre) && ($foo == false)) {
				echo (empty($value['image'])) ? "<td>".'<img class="fit-picture"'."src=../assets/no_image.jpg".">"."</td>" : "<td>".'<img class="fit-picture"'."src=../".$value['image'].">"."</td>";
				echo (empty($value['name'])) ? "<td>".'NA'."</td>" : "<td>".($value['name'])."</td>";
				echo (empty($value['description'])) ? "<td>".'NA'."</td>" : "<td>".($value['description'])."</td>";
				echo (empty($value['price'])) ? "<td>".'NA'."</td>" : "<td>".($value['price']*1.2)."</td>";
				while($ligne=mysqli_fetch_array($resultat)){
					echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
				}
				echo "<td><a href='main_op.php?delete=".$value['id']."' class='delete'>❌</a></td>";
				echo "<td><a href='update_product.php?id=".$value['id']."' class='modify'>📝</a></td>";
				$foo = true;
			}
	}

	if (empty($priceminentre) && empty($pricemaxentre)) {
		echo (empty($value['image'])) ? "<td>".'<img class="fit-picture"'."src=../assets/no_image.jpg".">"."</td>" : "<td>".'<img class="fit-picture"'."src=../".$value['image'].">"."</td>";
			echo (empty($value['name'])) ? "<td>".'NA'."</td>" : "<td>".($value['name'])."</td>";
			echo (empty($value['description'])) ? "<td>".'NA'."</td>" : "<td>".($value['description'])."</td>";
			echo (empty($value['price'])) ? "<td>".'NA'."</td>" : "<td>".($value['price']*1.2)."</td>";
			while($ligne=mysqli_fetch_array($resultat)){
				echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>".$ligne['MOY']."/5 </td>";
			}
			echo "<td><a href='main_op.php?delete=".$value['id']."' class='delete'>❌</a></td>";
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
	$priceminentre = $_POST['price_min'];
	$pricemaxentre = $_POST['price_max'];
} else {
	$priceminentre=0;
	$pricemaxentre=PHP_INT_MAX;
}
?>

<?php
//==============================================================================
if (!empty($_POST['bobine'])) {
    if ($value['catégorie']=="bobine") {
			grande_fonction($value,$priceminentre,$pricemaxentre,$foo);
    }
}
?>

<?php
if (!empty($_POST['machine'])) {
    if ($value['catégorie']=="machine") {
			grande_fonction($value,$priceminentre,$pricemaxentre,$foo);
    }
}
?>

<?php
if (empty($_POST['bobine']) && empty($_POST['machine'])) {
	grande_fonction($value,$priceminentre,$pricemaxentre,$foo);
}
echo "</tr>";
}

if (isset($_GET['delete'])){
    $del = "DELETE FROM product WHERE id=".$_GET['delete'];
    $conn->query($del);
    header('Location:main_op.php');
}
?>

</table>
</body>
</html>