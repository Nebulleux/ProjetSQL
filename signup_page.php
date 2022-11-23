<?php 
include("status/idle.php");
include("header.php"); 
include("config.php");
include("configCSS.html");

if (isset($_FILES['image']['name'])) {
  echo '<img src="'.$src.'">';
  echo '<br>';
  /***********************************************************
   * 1 - Upload Original Image To Server
   ***********************************************************/
  //Get Name | Size | Temp Location
  $ImageName = $_FILES['image']['name'];
  $ImageSize = $_FILES['image']['size'];
  $ImageTempName = $_FILES['image']['tmp_name'];

  //Get File Ext
  $ImageType = @explode('/', $_FILES['image']['type']);
  $type = $ImageType[1]; //file type
  //Set Upload directory
  $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/Halpper/';
  //Set File name
  $file_temp_name = $profile_id . '_original.' . md5(time()) . 'n' . $type; //the temp file name
  $fullpath = $uploaddir . "/" . $file_temp_name; // the temp file path
  $file_name = $profile_id . '_temp.jpeg'; //$profile_id.'_temp.'.$type; // for the final resized image
  $finalname = $profile_id . md5(time());
  $fullpath_2 = "assets/" . $finalname . "n.jpg"; //for the final resized image
  //Move the file to correct location
  if (move_uploaded_file($ImageTempName, $uploaddir . $fullpath_2)) {
      chmod($uploaddir . $fullpath_2, 0777);
  }
  //Check for valid uplaod
  if (!$move) {
      die ('File didnt upload');
  } else {
      $imgSrc = "assets/" . $file_name; // the image to display in crop area
      $msg = "Upload Complete!";   //message to page
      $src = $file_name;          //the file name to post from cropping form to the resize
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>
  </head>
  
  <body>
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

  $signup_query = mysqli_query ($conn,$sql);
  $check_user = mysqli_num_rows ($signup_query);
  if ($check_user == 0) {

    $login_query = mysqli_query ($conn,$sql2);
      $_SESSION["user_login"]=$signup_submit;
      header("Location: _usr/main_usr.php");
      echo "logged in";
  }
}
}
?>

  </body>
</html>
