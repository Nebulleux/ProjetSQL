<?php
session_start();
$_SESSION["group"] = get_session();
$_SESSION["log"] = get_login();
if (isset($_SESSION['userName'])) {
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

function get_session() {
    if(isset($_SESSION['userName'])) {
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

include("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Insertion d'un produit</title>
</head>

<body>
<?php
if (!empty($_POST['machine']) && $_POST['machine'] == "valid") {
    if (!empty($_POST['name']) && (!empty($_POST['description'])) && !empty($_POST['price']) && !empty($_POST['brand']) && (!empty($_POST['model'])) && !empty($_POST['heatingPlate']) && !empty($_POST['productType']) ) {
        $sql = "INSERT INTO product (name, description, price) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', '" . $_POST['price'] . "')";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO machine (productType, brand, model, heatingPlate, idProduct) VALUES ('" . $_POST['productType'] . "', '" . $_POST['brand'] . "', '" . $_POST['model'] . "', '" . $_POST['heatingPlate'] . "', '$last_id')";
            if (mysqli_query($conn, $sql2)) {
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

if (!empty($_POST['filament']) && $_POST['filament'] == "valid") {
    if (!empty($_POST['name']) && (!empty($_POST['description'])) && !empty($_POST['price']) && !empty($_POST['color']) && (!empty($_POST['diameter'])) && !empty($_POST['tempFusion']) && !empty($_POST['weight']) && !empty($_POST['dimension']) && !empty($_POST['productType'])  ) {
        $sql = "INSERT INTO product (name, description, price) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', '" . $_POST['price'] . "')";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO filament (productType, color, diameter, tempFusion, weight, dimension, idProduct) VALUES ('" . $_POST['productType'] . "', '" . $_POST['color'] . "', '" . $_POST['diameter'] . "', '" . $_POST['tempFusion'] . "', '" . $_POST['weight'] . "', '" . $_POST['dimension'] . "','$last_id')";
            if (mysqli_query($conn, $sql2)) {
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

if (!empty($_POST['accessoire']) && $_POST['accessoire'] == "valid") {
    if (!empty($_POST['name']) && (!empty($_POST['description'])) && !empty($_POST['price']) && !empty($_POST['material']) && !empty($_POST['productType'])) {
        $sql = "INSERT INTO product (name, description, price) VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', '" . $_POST['price'] . "')";
        if (mysqli_query($conn, $sql)) {
            $last_id = mysqli_insert_id($conn);
            $sql2 = "INSERT INTO accessory (productType, material, idProduct) VALUES ('" . $_POST['productType'] . "', '" . $_POST['material'] . "', '$last_id')";
            if (mysqli_query($conn, $sql2)) {
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}



if (!empty($_POST['produit']) && $_POST['produit'] == 1 && (empty($_POST['filament'])) && (empty($_POST['accessoire'])) && empty($_POST['machine'])) {
    ?>
    <h2>📥 Ajouter un nouvel article 📥</h2>

    <form action="insert_product.php" class="formulaire2" method="POST">

        Name : <br>
        <input type="text" name="name" required> <br>

        Description : <br>
        <input type="text" name="description" required> <br>

        Price : <br>
        <input type="text" name="price" required> <br>

        Brand : <br>
        <input type="text" name="brand" required> <br>

        Model : <br>
        <input type="text" name="model" required> <br>

        Heating Plate : <br>
        <input type="text" name="heatingPlate" required> <br>

        Product type : <br>
        <SELECT name="productType" id="productType" required>
            <?php
            $afficheMachineType = $conn->query("SELECT id,name FROM machinetype");
            while ($row = $afficheMachineType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '" required>' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="machine" value="valid"> <br>
            <input type="submit" value="Insérer">

    </form>

    <?php


} elseif (!empty($_POST['produit']) && $_POST['produit'] == 2 && (empty($_POST['filament'])) && (empty($_POST['accessoire'])) && empty($_POST['machine'])) {
    ?>
    <h2>📥 Ajouter un nouvel article 📥</h2>

    <form action="insert_product.php" class="formulaire2" method="POST">

        Name : <br>
        <input type="text" name="name" required> <br>

        Description : <br>
        <input type="text" name="description" required> <br>

        Price : <br>
        <input type="text" name="price" required> <br>

        Color : <br>
        <input type="text" name="color" required> <br>

        Diameter : <br>
        <input type="text" name="diameter" required> <br>

        Temp fusion : <br>
        <input type="text" name="tempFusion" required> <br>

        Weight : <br>
        <input type="text" name="weight" required> <br>

        Dimension : <br>
        <input type="text" name="dimension" required> <br>

        Product type : <br>
        <SELECT name="productType" id="productType">
            <?php
            $afficheFilamentType = $conn->query("SELECT id,name FROM filamenttype");
            while ($row = $afficheFilamentType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '" required>' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="filament" value="valid"> <br>


            <input type="submit" value="Insérer">

    </form>

    <?php

} elseif (!empty($_POST['produit']) && $_POST['produit'] == 3 && (empty($_POST['filament'])) && (empty($_POST['accessoire'])) && empty($_POST['machine'])) {
    ?>
    <h2>📥 Ajouter un nouvel article 📥</h2>

    <form action="insert_product.php" class="formulaire2" method="POST">

        Name : <br>
        <input type="text" name="name" required> <br>

        Description : <br>
        <input type="text" name="description" required> <br>

        Price : <br>
        <input type="text" name="price" required> <br>

        Material : <br>
        <input type="text" name="material" required> <br>

        Product type : <br>
        <SELECT name="productType" id="productType">
            <?php
            $afficheAccessoryType = $conn->query("SELECT id,name FROM accessorytype");
            while ($row = $afficheAccessoryType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '" required>' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="accessoire" value="valid"> <br>


            <input type="submit" value="Insérer">

    </form>

    <?php
}


/*

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

*/
?>


</body>

</html>