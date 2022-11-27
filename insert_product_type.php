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
    <title>Insertion d'un type de produit</title>
</head>

<body>
<?php

// $product = isset($_GET['product']);
// $modif = isset($_GET['modif']);
// echo isset($_GET['product']);
// echo isset($_GET['modif']);

if(isset($_GET['product'])) {
    $product = $_GET['product'];
} else {
    $product = '';
}

if(isset($_GET['modif'])) {
    $modif = $_GET['modif'];
} else {
    $modif = '';
}

if (!empty($_POST['produit']) && $_POST['produit'] == "machineajouter") { // Machine / Ajouter
    if (!empty($_POST['name']) ) {
        $sql = "INSERT INTO machinetype (name) VALUES ('" . $_POST['name'] . "')";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

// if (!empty($_POST['produit']) && $_POST['produit'] == "machinemodifier") {} // Machine / Modifier

if (!empty($_POST['produit']) && $_POST['produit'] == "machinesupprimer") { // Machine / supprimer
    if (!empty($_POST['productType']) ) {
        $sql = "DELETE FROM machinetype WHERE id = '" . $_POST['productType'] . "' ";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

if (!empty($_POST['produit']) && $_POST['produit'] == "filamentajouter") { // Filament / Ajouter
    if (!empty($_POST['name']) ) {
        $sql = "INSERT INTO filamenttype (name) VALUES ('" . $_POST['name'] . "')";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

// if (!empty($_POST['produit']) && $_POST['produit'] == "filamentmodifier") {} // Filament / Modifier

if (!empty($_POST['produit']) && $_POST['produit'] == "filamentsupprimer") { // Filament / supprimer
    if (!empty($_POST['productType']) ) {
        $sql = "DELETE FROM filamenttype WHERE id = '" . $_POST['productType'] . "' ";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}






if (!empty($_POST['produit']) && $_POST['produit'] == "accessoireajouter") { // Accessoire / Ajouter
    if (!empty($_POST['name']) ) {
        $sql = "INSERT INTO accessorytype (name) VALUES ('" . $_POST['name'] . "')";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}

// if (!empty($_POST['produit']) && $_POST['produit'] == "accessoiremodifier") {} // Accessoire / Modifier

if (!empty($_POST['produit']) && $_POST['produit'] == "accessoiresupprimer") { // Accessoire / supprimer
    if (!empty($_POST['productType']) ) {
        $sql = "DELETE FROM accessorytype WHERE id = '" . $_POST['productType'] . "' ";
        if (mysqli_query($conn, $sql)) {
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    header("Location: main.php");
}



if ($product == 1) { // Machine

    if ($modif == 1) { // Ajouter
        ?>
            <h2>📥 Ajouter un nouveau type de machine 📥</h2>

            <form action="insert_product_type.php" class="formulaire2" method="POST">

                Name : <br>
                <input type="text" name="name" required> <br>

            <input type="hidden" name="produit" value="machineajouter"> <br>
            <input type="submit" value="Ajouter">

            </form>
        <?php

    }


    if ($modif == 2) { // Modifier

    }

    if ($modif == 3) { // Supprimer
        ?>
        <form action="insert_product_type.php" class="formulaire2" method="POST">
            Product type : <br>
            <SELECT name="productType" id="productType">
            <?php
            $afficheMachineType = $conn->query("SELECT id,name FROM machinetype");
            while ($row = $afficheMachineType->fetch_assoc()) {
                echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
            }
            ?>

            <input type="hidden" name="produit" value="machinesupprimer"> <br>
            <input type="submit" value="Supprimer">

        </form>
        <?php
    }
}


if ($product == 2) { // Filament

    if ($modif == 1) { // Ajouter
        ?>
        <h2>📥 Ajouter un nouveau type de filament 📥</h2>

        <form action="insert_product_type.php" class="formulaire2" method="POST">

            Name : <br>
            <input type="text" name="name" required> <br>

            <input type="hidden" name="produit" value="filamentajouter"> <br>
            <input type="submit" value="Ajouter">

        </form>
        <?php

    }

    if ($modif == 2) { // Modifier

    }

    if ($modif == 3) { // Supprimer
        ?>
        <form action="insert_product_type.php" class="formulaire2" method="POST">
            Product type : <br>
            <SELECT name="productType" id="productType">
                <?php
                $afficheMachineType = $conn->query("SELECT id,name FROM filamenttype");
                while ($row = $afficheMachineType->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>

                <input type="hidden" name="produit" value="filamentsupprimer"> <br>
                <input type="submit" value="Supprimer">

        </form>
        <?php
    }
}

if ($product == 3) { // Accessoire

    if ($modif == 1) { // Ajouter
        ?>
        <h2>📥 Ajouter un nouveau type d'accessoire 📥</h2>

        <form action="insert_product_type.php" class="formulaire2" method="POST">

            Name : <br>
            <input type="text" name="name" required> <br>

            <input type="hidden" name="produit" value="accessoireajouter"> <br>
            <input type="submit" value="Ajouter">

        </form>
        <?php

    }

    if ($modif == 2) { // Modifier

    }

    if ($modif == 3) { // Supprimer
        ?>
        <form action="insert_product_type.php" class="formulaire2" method="POST">
            Product type : <br>
            <SELECT name="productType" id="productType">
                <?php
                $afficheMachineType = $conn->query("SELECT id,name FROM accessorytype");
                while ($row = $afficheMachineType->fetch_assoc()) {
                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                }
                ?>

                <input type="hidden" name="produit" value="accessoiresupprimer"> <br>
                <input type="submit" value="Supprimer">

        </form>
        <?php
    }
}




?>


</body>

</html>