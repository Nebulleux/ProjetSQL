<?php 
session_start();
$_SESSION["group"] = get_session();
if(isset($_SESSION['userName'])) {
	echo "Your session is running " . $_SESSION['userName'];
	$root = $_SESSION['userName'];
	if ($_SESSION['userName'] == 'User') {
		include("header_op.php");
		include("configCSS_adm.html");
	} else if ($_SESSION['userName'] == 'Root') {
		include("header_op.php");
		include("configCSS_adm.html");
	} else {
		include("header.php");
		include("configCSS.html");
	}
  } else {
	include("header.php");
	include("configCSS.html");
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
        <h1>Qui sommes-nous ?</h1>

        <p> ROPP Jean-Baptiste</p>
        <br>
        <p> MICHEL Loïc</p>
        <br>
        <p> BENNOUR Yanis</p>
        <br><br><br>

    </div>


</body>

</html>