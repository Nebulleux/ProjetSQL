<?php 
include("status/idle.php");
include("header.php"); ?>


<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "jbropp_01";
    $conn = mysqli_connect($servername, $username, $password,$db);
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="assets/style.css">
	  <link rel="stylesheet" href="assets/header-login-signup.css">
  </head>
  
  <body>
	<h2>📥 Inscription 📥</h2>

    <form action="signup_page.php" class="centre" method="POST">
        Email : <br>
        <input type="text" name="email"> <br>

        Login : <br>
        <input type="text" name="login"> <br>
        
        Mot de passe : <br>
        <input type="text" name="password"> <br>
        <input type="submit" name="signup_submit" value="S'inscrire">
    </form>

<?php
if (!empty($_POST['login']) && (!empty($_POST['password']))) {
$signup_submit = ($_POST['signup_submit']);
if ($signup_submit){
  $sql = "SELECT * FROM users WHERE login = '".$_POST['login']."' AND password = '".$_POST['password']."'";

  $sql2 = "INSERT INTO Users (login, password, email) VALUES ( '".$_POST['login']."',  '".$_POST['password']."', '".$_POST['email']."')";

  $signup_query = mysqli_query ($conn,$sql);
  // mae the query, now we check if the user exists
  $check_user = mysqli_num_rows ($signup_query);
  if ($check_user == 0) {

    $login_query = mysqli_query ($conn,$sql2);
      // if there is a valid user in the db, if the results returned are one row, then log the user in, otherwise error
      // we need to create to session variables for  user so the user can log in, save details etc.
      $_SESSION["user_login"]=$signup_submit;
      header("Location: _adm/main_op.php");
      echo "logged in";
  }
}
}
//Error messages when user don't fill password &&/|| login
if (empty($_POST['login'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Nom d'utilisateur manquant</div>
	<?php }
if (empty($_POST['password'])) { ?>
	<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Mot de passe manquant.</div>
	<?php }

if (empty($_POST['email'])) { ?>
	<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Email manquant.</div>
	<?php }

?>




  </body>
</html>
