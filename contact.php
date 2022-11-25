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
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Contact</title>

</head>

<body>
    <div>
        <br>
        <h1 style="text-align:center">Qui sommes-nous ?</h1>

        <p style="text-align:center"> ROPP Jean-Baptiste <br> MICHEL Loïc <br> BENNOUR Yanis</p>
    </div>


</body>

</html>