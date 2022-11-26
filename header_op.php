<?php
$_SESSION["group"] = get_session();
if (isset($_SESSION['userName'])) {
	$root = $_SESSION['userName'];
}
include("config.php");
?>

<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

<header class="header-user-dropdown">

    <div class="header-limiter">
        <h1><a href="main.php">🌌Gros<span>3D🌌</span></a>
        </h1>

        <nav>
            <?php
            if ($_SESSION['group'] == 'Root' || $_SESSION['group'] == 'User') {
                
            }
            
            if ($_SESSION["group"] == 'Root') {
                    echo '<a href="statistic.php"> Statistiques (admin) </a>';
			    }
            ?>
            <a href="insert_product_form.php"> Ajouter un produit</a>
            <a href="thread.php"> Fil d'actualité </a>
            <a href="follow.php"> Utilisateurs suivis </a>
            <a href="contact.php">Nous contacter</a>
        </nav>


        <div class="header-user-menu">
            <?php
            echo (empty($_SESSION["profile_picture"])) ? '<img src="assets/no_pp.png"/>' : '<img src="'.$_SESSION["profile_picture"].'"/>';
            ?>
            <ul>
                <li><a href="#"><?php $login ?></a></li>
                <?php echo '<li><a> '.$_SESSION['login'].' </a></li>' ?>
                <li><a href="user_notes.php">Notations</a></li>
                <li><a href="reset.php" class="highlight">Déconnexion</a></li>

            </ul>
        </div>

    </div>

</header>

<!-- The content of your page would go here. -->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        var userMenu = $('.header-user-dropdown .header-user-menu');

        userMenu.on('touchend', function (e) {

            userMenu.addClass('show');

            e.preventDefault();
            e.stopPropagation();

        });

        // This code makes the user dropdown work on mobile devices

        $(document).on('touchend', function (e) {

            // If the page is touched anywhere outside the user menu, close it
            userMenu.removeClass('show');

        });

    });

</script>