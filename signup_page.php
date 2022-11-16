<?php 
include("status/idle.php");
include("header.php"); 
include("config.php");
include("configCSS.html");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
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
  if (empty($_POST['login']) && isset($_POST['login'])) { ?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Nom d'utilisateur manquant</div>
    <?php }
  if (empty($_POST['password']) && isset($_POST['login'])) { ?>
    <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Mot de passe manquant.</div>
    <?php }
  if (empty($_POST['email']) && isset($_POST['email'])) { ?>
	  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Email manquant.</div>
	  <?php }


if (!empty($_POST['login']) && (!empty($_POST['password']))) {
$signup_submit = ($_POST['signup_submit']);
if ($signup_submit){
  $sql = "SELECT * FROM utilisateur WHERE username = '".$_POST['login']."' AND password = '".$_POST['password']."'";

  $sql2 = "INSERT INTO utilisateur (username, password, email) VALUES ( '".$_POST['login']."',  '".$_POST['password']."', '".$_POST['email']."')";

  $signup_query = mysqli_query ($conn,$sql);
  $check_user = mysqli_num_rows ($signup_query);
  if ($check_user == 0) {

    $login_query = mysqli_query ($conn,$sql2);
      $_SESSION["user_login"]=$signup_submit;
      header("Location: _adm/main_op.php");
      echo "logged in";
  }
}
}
?>

  </body>
</html>
