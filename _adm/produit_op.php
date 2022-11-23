<?php
include("../status/connected.php");
include("header_op.php");
include("../config.php");
include("configCSS_adm.html");
?>
<html>

<head>
	<title>Page produit</title>
</head>

<body>

	<?php
    $idget = ($_GET["id"]);
    echo "<br><br><h2>Affichage produit</h2><br>";
    echo "Vous êtes actuellement sur le produit n°" . $idget;
    echo "<br><br><br>";

    $connectaumax = $conn->query("SELECT * FROM product WHERE id = " . $idget);
    while ($row = $connectaumax->fetch_assoc()) {
	    echo (empty($row['image'])) ? '<img class="fit-picture"' . "src=../assets/no_image.jpg" . ">" : '<img class="fit-picture"' . "src=../" . $row['image'] . ">";
	    echo "<br>";

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

	    echo "Note: ";
	    echo $row['rating'];
	    echo "<br>";

    }
    ?>


</body>

</html>