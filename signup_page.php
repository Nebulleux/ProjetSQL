<?php 
include("status/idle.php");
include("header.php"); 
include("config.php");
include("configCSS.html");
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  
  <body>

<?php
global $actual_image;
if (strpos($url,'?image=assets/pp/') !== false) { 
  $actual_image = substr($url, strpos($url, "assets/pp/"));   
  ?>
  <div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>L'image a été uploadée avec succès !</div>
<?php 
  echo '<img class="fit-picture"'."src=".$actual_image.">";
  } 
?>


	<h2>📥 Inscription 📥</h2>
    <form action="upload.php" class="form-container" enctype="multipart/form-data" method="POST">
      Photo de profil (formats acceptés: png,gif,jpeg): <br>
        <input type="file" name="fileToUpload" id="fileToUpload" accept="image/x-png,image/gif,image/jpeg" />
        <input type="submit" name="submit" value="Upload">
    </form>

    <?php
      if (!empty($_POST['image'])) {
      }
    ?>

    <form action="signup_page.php" class="form-container" method="POST">
        Email* : <br>
        <input type="text" name="email"> <br>

        Login* : <br>
        <input type="text" name="login"> <br>
        
        Mot de passe* : <br>
        <input type="text" name="password"> <br>

        <input type="submit" name="signup_submit" value="S'inscrire">
    </form>
  
  <p style="color:#FF0000">*Champs obligatoires !!</p>

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
  
  $sql3 = "INSERT INTO utilisateur (image) VALUES ($actual_image)";

  if (var_dump(isset($actual_image))) {
    $image_query = mysqli_query ($conn,$sql3);
    echo "fanta";
  }

  $signup_query = mysqli_query ($conn,$sql);
  $check_user = mysqli_num_rows ($signup_query);
  if ($check_user == 0) {

    $login_query = mysqli_query ($conn,$sql2);
      $_SESSION["user_login"]=$signup_submit;
      //header("Location: _usr/main_usr.php");
      echo "logged in";
  }
}
}
?>

  </body>
</html>
