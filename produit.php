<?php
include("status/idle.php");
include("header.php");
include("config.php");
include("configCSS.html");
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
	    echo (empty($row['image'])) ? '<img class="fit-picture"' . "src=assets/no_image.jpg" . ">" : '<img class="fit-picture"' . "src=" . $row['image'] . ">";
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
    }
    echo "Moyenne des notes: ";
    $sql2 = 'SELECT CAST(AVG(rating.rate) AS DECIMAL(5, 2)) as MOY FROM rating,product WHERE rating.idProduct =' . $idget;
    $resultat = $conn->query($sql2);
    while ($ligne = mysqli_fetch_array($resultat)) {
	    echo (empty($ligne['MOY'])) ? "0/5" : $ligne['MOY'] . "/5";
    }
    echo "<br>";
    echo "<br><br><h2>Avis</h2><br>";
    ?>
	<table>
		<tr>
			<th>Date</th>
			<th>Utilisateur</th>
			<th>Note</th>
			<th>Commentaire</th>
		</tr>
		<?php
        $connect2 = $conn->query('SELECT DISTINCT rating.dateOfPub as "date",utilisateur.username as "user",rating.rate as "rate",rating.comm as "comm" FROM utilisateur,rating,product WHERE utilisateur.id = rating.idUser AND rating.idProduct =' . $idget);
        while ($row2 = $connect2->fetch_assoc()) {
	        echo (empty($row2['date'])) ? "<td> NA </td>" : "<td>" . $row2['date'] . "</td>";
	        echo (empty($row2['user'])) ? "<td> NA </td>" : "<td>" . $row2['user'] . "</td>";
	        echo (empty($row2['rate'])) ? "<td> NA </td>" : "<td>" . $row2['rate'] . "/5 </td>";
	        echo (empty($row2['comm'])) ? "<td> NA </td>" : "<td>" . $row2['comm'] . "</td>";
	        echo "<tr>";
        }
        ?>
</body>

</html>