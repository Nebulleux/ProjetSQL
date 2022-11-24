<?php 
session_start();
if(isset($_SESSION['userName'])) {
	echo "Your session is running " . $_SESSION['userName'];
    $_SESSION['userName'] = 0;
    session_destroy();
    header("Location: main.php");
  } else {
    header("Location: main.php");
  }
?>