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

    $sql = "SELECT * FROM machine WHERE idProduct = '" . $idget . "' ";
    $sql2 = "SELECT * FROM accessory WHERE idProduct = '" . $idget . "' ";
    $sql3 = "SELECT * FROM filament WHERE idProduct = '" . $idget . "' ";


    $signup_query_machine = mysqli_query($conn, $sql);
    $signup_query_accessory = mysqli_query($conn, $sql2);
    $signup_query_filament = mysqli_query($conn, $sql3);


    $check_user_machine = mysqli_num_rows($signup_query_machine);
    $check_user_accessory = mysqli_num_rows($signup_query_accessory);
    $check_user_filament = mysqli_num_rows($signup_query_filament);

    if ($check_user_machine == 1) { // Checks if it's a machine
        $afficheMachine = $conn->query("SELECT * FROM machine, product WHERE idProduct = ". $idget . " AND product.id = idProduct");
        while ($row = $afficheMachine->fetch_assoc()) {
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $productType = $row['productType'];
            $brand = $row['brand'];
            $model = $row['model'];
            $heatingPlate = $row['heatingPlate'];

            echo '<form class="formulaire2" method="POST">';

            echo 'Name : <br>';
            echo '<input type="text" name="name" value="' . $name . '" required> <br>';

            echo 'Description : <br>';
            echo '<input type="text" name="description" value="' . $description . '"required> <br>';

            echo 'Price : <br>';
            echo '<input type="number" step="0.01" name="price" value="' . $price . '" required> <br>';

            echo 'Brand : <br>';
            echo '<input type="text" name="brand" value="' . $brand . '" required> <br>';

            echo 'Model : <br>';
            echo '<textarea name="model" required>' . $model . '</textarea> <br><br>';

            echo 'Heating Plate : <br>';
            echo '<input type="text" name="heatingPlate" value="' . $heatingPlate . '" required> <br>';

            echo 'Product type : <br>';
            echo '<SELECT name="productType" id="productType" required>';
            $afficheMachineType = $conn->query("SELECT id,name FROM machinetype");
            while ($row = $afficheMachineType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="machine" value="valid"> <br>
            <input type="submit" value="Insérer">

            <?php
        }
        ?>

        <input type="button" onclick="location.href='./main.php';" value="Retour liste" />
        </form>
        <?php


    }

    if ($check_user_accessory == 1) { // Checks if it's a accessory

        $afficheAccessory = $conn->query("SELECT * FROM accessory, product WHERE idProduct = ". $idget . " AND product.id = idProduct");
        while ($row = $afficheAccessory->fetch_assoc()) {
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $productType = $row['productType'];
            $material = $row['material'];

            echo '<form class="formulaire2" method="POST">';

            echo 'Name : <br>';
            echo '<input type="text" name="name" value="' . $name . '" required> <br>';

            echo 'Description : <br>';
            echo '<input type="text" name="description" value="' . $description . '"required> <br>';

            echo 'Price : <br>';
            echo '<input type="number" step="0.01" name="price" value="' . $price . '" required> <br>';

            echo 'material : <br>';
            echo '<input type="text" name="material" value="' . $material . '" required> <br>';


            echo 'Product type : <br>';
            echo '<SELECT name="productType" id="productType" required>';
            $afficheAccessoryType = $conn->query("SELECT id,name FROM accessorytype");
            while ($row = $afficheAccessoryType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="accessory" value="valid"> <br>
            <input type="submit" value="Insérer">

            <?php
        }
        ?>

        <input type="button" onclick="location.href='./main.php';" value="Retour liste" />
        </form>
        <?php

    }

    if ($check_user_filament == 1) { // Checks if it's a filament
        $afficheFilament = $conn->query("SELECT * FROM filament, product WHERE idProduct = ". $idget . " AND product.id = idProduct");
        while ($row = $afficheFilament->fetch_assoc()) {
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $productType = $row['productType'];
            $color = $row['color'];
            $diameter = $row['diameter'];
            $tempFusion = $row['tempFusion'];
            $weight = $row['weight'];
            $dimension = $row['dimension'];

            echo '<form class="formulaire2" method="POST">';

            echo 'Name : <br>';
            echo '<input type="text" name="name" value="' . $name . '" required> <br>';

            echo 'Description : <br>';
            echo '<input type="text" name="description" value="' . $description . '"required> <br>';

            echo 'Price : <br>';
            echo '<input type="number" step="0.01" name="price" value="' . $price . '" required> <br>';

            echo 'Color : <br>';
            echo '<input type="text" name="color" value="' . $color . '" required> <br>';

            echo 'Diameter : <br>';
            echo '<input type="number" step="0.01" name="diameter" value="' . $diameter . '" required> <br>';

            echo 'Temp Fusion : <br>';
            echo '<input type="number" step="0.01" name="tempFusion" value="' . $tempFusion . '" required> <br>';

            echo 'Weight : <br>';
            echo '<input type="number" step="0.01" name="weight" value="' . $weight . '" required> <br>';

            echo 'Dimension : <br>';
            echo '<input type="number" step="0.01" name="dimension" value="' . $dimension . '" required> <br>';

            echo 'Product type : <br>';
            echo '<SELECT name="productType" id="productType" required>';
            $afficheMachineType = $conn->query("SELECT id,name FROM filamenttype");
            while ($row = $afficheMachineType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="filament" value="valid"> <br>
            <input type="submit" value="Insérer">

            <?php
        }
        ?>

        <input type="button" onclick="location.href='./main.php';" value="Retour liste" />
        </form>
        <?php


    }

    if (!empty($_POST['machine']) && $_POST['machine'] == "valid" ) {
        $sql = "UPDATE machine SET brand='" . $_POST['brand'] . "', model='" . $_POST['model'] . "', heatingPlate='" . $_POST['heatingPlate'] . "', productType='" . $_POST['productType'] . "' WHERE idProduct=" . $_GET['id'];
        $sql2 = "UPDATE product SET name='" . $_POST['name'] . "', description='" . $_POST['description'] . "', price='" . $_POST['price'] . "' WHERE id=" . $_GET['id'];
        if (mysqli_query($conn, $sql)) {
            echo "Produit modifié avec succès";
            if (mysqli_query($conn, $sql2)) {
                echo "Product modifié avec succès";
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if (!empty($_POST['accessory']) && $_POST['accessory'] == "valid" ) {
        $sql = "UPDATE accessory SET material='" . $_POST['material'] . "', productType='" . $_POST['productType'] . "' WHERE idProduct=" . $_GET['id'];
        $sql2 = "UPDATE product SET name='" . $_POST['name'] . "', description='" . $_POST['description'] . "', price='" . $_POST['price'] . "' WHERE id=" . $_GET['id'];
        if (mysqli_query($conn, $sql)) {
            if (mysqli_query($conn, $sql2)) {
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    if (!empty($_POST['filament']) && $_POST['filament'] == "valid" ) {

        $sql = "UPDATE filament SET color='" . $_POST['color'] . "', diameter='" . $_POST['diameter'] . "', tempFusion='" . $_POST['tempFusion'] . "', weight='" . $_POST['weight'] . "', dimension='" . $_POST['dimension'] . "', productType='" . $_POST['productType'] . "' WHERE idProduct=" . $_GET['id'];
        $sql2 = "UPDATE product SET name='" . $_POST['name'] . "', description='" . $_POST['description'] . "', price='" . $_POST['price'] . "' WHERE id=" . $_GET['id'];
        if (mysqli_query($conn, $sql)) {
            if (mysqli_query($conn, $sql2)) {
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    ?>



    </body>

</html>