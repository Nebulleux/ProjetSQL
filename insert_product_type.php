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

$product = isset($_GET['product']);
$modif = isset($_GET['modif']);

if (!empty($_POST['produit']) && $_POST['produit'] == "machine/ajouter") { // Machine / Ajouter
    if (!empty($_POST['name']) ) {
        $sql = "INSERT INTO machinetype (name) VALUES ('" . $_POST['name'] . "')";
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

            <input type="hidden" name="produit" value="machine/ajouter"> <br>
            <input type="submit" value="Ajouter">

            </form>
        <?php

        }

    }

    if ($modif == 2) { // Modifier
        
    }

    if ($modif == 3) { // Supprimer

    }


if ($product == 2) { // Filament

    if ($modif == 1) {

    }

    if ($modif == 2) {

    }

    if ($modif == 3) {

    }
}

if ($product == 3) {

    if ($modif == 1) {

    }

    if ($modif == 2) {

    }

    if ($modif == 3) {

    }
}




?>


</body>

</html>