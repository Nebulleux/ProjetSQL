<?php 
include("status/idle.php");
include("header.php"); 
include("config.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Connexion</title>

    <link rel="stylesheet" href="assets/style.css">
	  <link rel="stylesheet" href="assets/header-login-signup.css">

  </head>

  <body>
	<h2>📥 Connexion 📥</h2>

    <form action="login_page.php" class="centre" method="POST">
        Login : <br>
        <input type="text" name="login"> <br>
        
        Mot de passe : <br>
        <input type="password" name="password"> <br>
        
        <input type="submit" name="login_submit" value="Se connecter">
    </form>

<?php
  if (empty($_POST['login']) && isset($_POST['login'])) { ?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Nom d'utilisateur manquant</div>
    <?php }
  if (empty($_POST['password']) && isset($_POST['login'])) { ?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Mot de passe manquant.</div>
    <?php }

if (!empty($_POST['login']) && (!empty($_POST['password']))) {

$login_submit = ($_POST['login_submit']);
if ($login_submit){

  $sql = "SELECT * FROM users WHERE login = '".$_POST['login']."' AND password = '".$_POST['password']."'";

  $login_query = mysqli_query ($conn,$sql);
  // mae the query, now we check if the user exists
  $check_user = mysqli_num_rows ($login_query);

  if ($check_user == 1) {

      // if there is a valid user in the db, if the results returned are one row, then log the user in, otherwise error
      // we need to create to session variables for  user so the user can log in, save details etc.
      $_SESSION["user_login"]=$login_submit;
      header("Location: _adm/main_op.php");
      echo "logged in";
  
  } else {?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Accès refusé !</div>
  <?php }
}
}
//Error messages when user don't fill password &&/|| login

?>




  </body>
</html>
