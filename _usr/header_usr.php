<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
<body>
    <header class="header-user-dropdown">
    
    <div class="header-limiter">
        <h1><a <?php if($connected) { echo 'href="main_usr.php"'; } else { echo 'href="main.php"'; }?>>🌌Grossiste<span>3D🌌</span></a></h1>

        <nav>
            <a href="contact_usr.php">Nous contacter</a>
            <a href="#"><div>
                <input type="button" onclick="location.href='./insert_product.php';" value="Ajouter un produit" />
            </div></a>
        </nav>
    
    
        <div class="header-user-menu">
            <img src="../assets/pp.png" alt="User Image"/>
    
            <ul>
                <li><a href="#"><?php $login ?></a></li>
                <li><a href="#">Notations</a></li>
                <li><a href="../main.php" class="highlight">Déconnexion</a></li>
                
            </ul>
        </div>
    
    </div>
    
    </header>
    
    <!-- The content of your page would go here. -->
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
    
    $(document).ready(function(){
    
        var userMenu = $('.header-user-dropdown .header-user-menu');
    
        userMenu.on('touchend', function(e){
    
            userMenu.addClass('show');
    
            e.preventDefault();
            e.stopPropagation();
    
        });
    
        // This code makes the user dropdown work on mobile devices
    
        $(document).on('touchend', function(e){
    
            // If the page is touched anywhere outside the user menu, close it
            userMenu.removeClass('show');
    
        });
    
    });
    
    </script>