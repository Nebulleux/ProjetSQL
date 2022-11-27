<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu utilisateur '.$_SESSION['login'].'</h1>';

	} else if ($_SESSION['userName'] == 'Root') {

		include("configCSS_adm.html");
		include("header_op.php");
		echo '<h1 style="color:white;text-align:center;">Bienvenu administrateur '.$_SESSION['login'].'</h1>';

	} else {

		include("configCSS.html");
		include("header.php");

	}
} else {

	include("configCSS.html");
	include("header.php");

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
	<title>Catalogue [Invite]</title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Grossiste3D [Invite]</title>
</head>

<h2 id=filtre>🔎 Filtrer les produits 🔍</h2>
<div class="box">
	<form method="post">
		<div class="col">
			<div class=formulaire>
				<SELECT name="catType" id="catType">
				<option value="0">-</option>
				<option value="1">ID</option>
				<option value="2">Nom</option>
				<option value="3">Description</option>
				<option value="4">Prix</option>
				</SELECT>

				<SELECT name="orderType" id="orderType">
				<option value="5">ASC ⬇</option>
				<option value="6">DESC ⬆</option>
				</SELECT>

				<SELECT name="basicType" id="basicType">
				<option value="-">-</option>
				<option value="7">Machine 📠</option>
				<option value="8">Filament 🧵</option>
				<option value="9">Accessoire 👜</option>
				</SELECT>
				<br>
				<input type="submit" value="Trier" name="sort">
				<input type="reset" value="Effacer les champs">

			</div>
		</div></div>
	</form>

		<form method="post">
			<div class=formulaire >
				<input type="search" id="query" name="q" placeholder="Search...">
				<br>
				<input type="submit" value="Rechercher" name="recherche">
			</div>
		</form>

	<div class="col">
		<img 
		<?php 
		if (isset($_SESSION['userName']) == 'User' || isset($_SESSION['userName']) == 'Root') 
		{ echo 'style="top:250px;"';
		} else echo 'style="top:210px;"';;
		?>
		 class="gif" src="assets/bg.gif">
	
</div>



<h2>🛒 Articles Disponibles 🛒</h2>
<table>
	<tr>
		<th>Image</th>
		<th>Libellé</th>
		<th>Description</th>
		<th>Prix TTC</th>
		<th>Notation</th>
		<?php
        if ($_SESSION["group"] == 'User') {
	        echo '<th>Avis ?</th>';
        }
        ?>
	</tr>

	<?php

if (isset($_POST['sort'])) {

	if ($_POST['basicType'] == '7') {
		if ($_POST['catType'] == '1' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.id ASC";
		} else if($_POST['catType'] == '1' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.id ASC";

		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.name ASC";
		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.name DESC";

		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.description ASC";
		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.description DESC";

		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.price ASC";
		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct ORDER BY product.price DESC";

		} else if($_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct";
		} else if($_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN machine ON product.id = machine.idProduct";
		} else {
			return '';
		}
	} else if ($_POST['basicType'] == '8') {
		if ($_POST['catType'] == '1' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.id ASC";
		} else if($_POST['catType'] == '1' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.id DESC";

		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.name ASC";
		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.name DESC";

		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.description ASC";
		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.description DESC";

		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.price ASC";
		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct ORDER BY product.price DESC";

		} else if($_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct";
		} else if($_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN filament ON product.id = filament.idProduct";
		} else {
			return '';
		}
	} else if ($_POST['basicType'] == '9') {
		if ($_POST['catType'] == '1' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.id ASC";
		} else if($_POST['catType'] == '1' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.id DESC";

		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.name ASC";
		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.name DESC";

		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.description ASC";
		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.description DESC";

		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.price ASC";
		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct ORDER BY product.price DESC";

		} else if($_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct";
		} else if($_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product RIGHT JOIN accessory ON product.id = accessory.idProduct";

		} else {
			return '';
		}
	} else {
		if ($_POST['catType'] == '1' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product ORDER BY product.id ASC";
		} else if($_POST['catType'] == '1' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product ORDER BY product.id DESC";

		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product ORDER BY product.name ASC";
		} else if($_POST['catType'] == '2' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product ORDER BY product.name DESC";

		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product ORDER BY product.description ASC";
		} else if($_POST['catType'] == '3' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product ORDER BY product.description DESC";

		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '5') {
			$connectaumax ="SELECT * FROM product ORDER BY product.price ASC";
		} else if($_POST['catType'] == '4' && $_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product ORDER BY product.price DESC";

		} else if($_POST['orderType'] == '5') {
			$connectaumax = "SELECT * FROM product";
		} else if($_POST['orderType'] == '6') {
			$connectaumax = "SELECT * FROM product";

		} else {
			return '';
		}
	}

} else {
$connectaumax = "SELECT * FROM product";
}

if (isset($_POST['recherche'])) {
	$request1 = $_POST['q'];
	$connectaumax = "SELECT * FROM product WHERE product.name LIKE \"".$request1.'"';

}

echo $connectaumax;
$queryaumax = $conn->query($connectaumax);

foreach ($queryaumax as $value) {
    ?>

	<tr id=line onclick="document.location = 'produit.php?id=<?= $value['id'] ?>'">

		<?php
		$sql = 'SELECT CAST(AVG(rating.rate) AS DECIMAL(5, 1)) as MOY FROM rating,product WHERE rating.idProduct =' . $value['id'];
		$resultat = $conn->query($sql);

		echo (empty($value['image'])) ? "<td>" . '<img class="fit-picture"' . "src=assets/no_image.png" . ">" . "</td>" : "<td>" . '<img class="fit-picture"' . "src=" . $value['image'] . ">" . "</td>";
		echo (empty($value['name'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['name']) . "</td>";
		echo (empty($value['description'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['description']) . "</td>";
		echo (empty($value['price'])) ? "<td>" . 'NA' . "</td>" : "<td>" . ($value['price'] * 1.2) . "</td>";
		while ($ligne = mysqli_fetch_array($resultat)) {
			echo (empty($ligne['MOY'])) ? "<td> 0/5 </td>" : "<td>" . $ligne['MOY'] . "/5 </td>";
		}
		if ($_SESSION["group"] == 'Root') {
			echo "<td class='review'><a href='review.php?id=" . $value['id'] . "'>🤔</a></td>";
			echo "<td><a href='main.php?delete=" . $value['id'] . "' class='delete'>❌</a></td>";
			echo "<td><a href='update_product.php?id=" . $value['id'] . "' class='modify'>📝</a></td>";
		}
		if ($_SESSION["group"] == 'User') {
			echo "<td class='review'><a href='review.php?id=" . $value['id'] . "'>🤔</a></td>";
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