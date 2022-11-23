<link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

<body>
    <header class="header-login-signup">

        <div class="header-limiter">
            <h1><a <?php if ($connected) {
                echo 'href="_adm/main_op.php"';
            } else {
                echo 'href="main.php"';
            } ?>>🌌Grossiste<span>3D🌌</span></a>
            </h1>

            <nav>
                <a href="contact.php">Nous contacter</a>
            </nav>

            <ul>
                <li><a href="login_page.php">Login</a></li>
                <li><a href="signup_page.php">Sign up</a></li>
            </ul>

        </div>

    </header>

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