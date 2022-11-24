<?php
session_start();   // in top of PHP file
$_SESSION["image"] = get_pp();
include("configCSS.html");
include("header.php");
include("config.php");

function get_pp() {
  if(isset($_GET['image'])) {
    return $_GET['image'];
  } else {
    return '';
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
  <form class="form-container" method="POST">
    Email* : <br>
    <input type="text" name="email" required> <br>
    Login* : <br>
    <input type="text" name="login" required> <br>
    Mot de passe* : <br>
    <input type="text" name="password" required> <br>
    <input type="submit" name="signup_submit2" value="Upload">
  </form>
  <p style="color:#FF0000">*Champs obligatoires !!</p>

  <?php
  if (isset($_GET['image'])) { //si la photo a été envoyée ?> 
  <div class="alert2"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>L'image
  <?php echo ($_GET['image']) ?> a été uploadée avec succès ! Entrez maintenant vos nouveaux identifiants afin de poursuivre la création de compte !</div>
  <?php echo '<img class="fit-picture"' . "src=" . ($_GET['image']) . ">";
  }
  ?>

  <?php
  if (empty($_POST['login']) && isset($_POST['login'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Nom
    d'utilisateur manquant</div>
  <?php }
  if (empty($_POST['password']) && isset($_POST['login'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Mot de
    passe manquant.</div>
  <?php }
  if (empty($_POST['email']) && isset($_POST['email'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Email
    manquant.</div>
  <?php }



  if (!empty($_POST['login']) && (!empty($_POST['password'])) && isset($_POST['signup_submit2'])) {
    $signup_submit2 = $_POST['signup_submit2'];
    $sql = "SELECT * FROM utilisateur WHERE username = '" . $_POST['login'] . "' AND password = '" . $_POST['password'] . "'";
    $sql2 = "INSERT INTO utilisateur (username, password, email) VALUES ( '" . $_POST['login'] . "',  '" . $_POST['password'] . "', '" . $_POST['email'] . "')";
    $sql3 = "INSERT INTO utilisateur (username, password, email, image) VALUES ( '" . $_POST['login'] . "',  '" . $_POST['password'] . "', '" . $_POST['email'] . "', '" . $_SESSION["image"] . "')";
    $signup_query = mysqli_query($conn, $sql);
    $check_user = mysqli_num_rows($signup_query);

      if ($check_user == 0) {

        if (!empty($_SESSION["image"])) {
        $image_query = mysqli_query($conn, $sql3);
        $_SESSION["user_login"] = $signup_submit2;
        $_SESSION["profile_picture"] = $_SESSION["image"];
        $_SESSION['userName'] = 'User';
        header("Location: main.php");
        }

        if (empty($_SESSION["image"])) {
          $login_query = mysqli_query($conn, $sql2);
          $_SESSION["user_login"] = $signup_submit2;
          $_SESSION["profile_picture"] = $_SESSION["image"];
          $_SESSION['userName'] = 'User';
          header("Location: main.php");
          }
      }

    } else if (isset($_POST['signup_submit2'])) { 
    ?>
<div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Ce compte existe déjà.</div>
    <?php 
    }
  ?>

</body>

</html>