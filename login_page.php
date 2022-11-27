<?php
session_start();
if(isset($_SESSION['userName'])) {
}

include("configCSS.html");
include("header.php");
include("config.php");

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Connexion</title>
</head>

<body>
  <h2>📥 Connexion 📥</h2>

<div class=formulaire2>
  <form action="login_page.php" class="form-container" method="POST">
    Login : <br>
    <input type="text" name="login" placeholder="Votre nom d'utilisateur"> <br>

    Mot de passe : <br>
    <input type="password" name="password" placeholder="Votre mot de passe"> <br>

    <input type="submit" name="login_submit" value="Se connecter">
  </form>
</div>
  <?php
  if (empty($_POST['login']) && isset($_POST['login'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Nom
    d'utilisateur manquant</div>
  <?php }
  if (empty($_POST['password']) && isset($_POST['login'])) { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Mot de
    passe manquant.</div>
  <?php }

  if (!empty($_POST['login']) && (!empty($_POST['password']))) {

    $login_submit = ($_POST['login_submit']);
    $login = ($_POST['login']);
    $password = ($_POST['password']);

    if ($login_submit) {

      $sql = "SELECT * FROM utilisateur WHERE username = '$login' AND password = '$password'";
      $sql2 = "SELECT groupe.id, utilisateur.username FROM groupe, utilisateur, groupuser WHERE groupuser.idGroup = groupe.id AND utilisateur.id = groupuser.idUser AND groupe.id=1 AND utilisateur.username = '$login'";
      $sql3 = "SELECT image FROM utilisateur WHERE username = '$login' AND password = '$password'";
      
            // USER CHECK
            $login_query = mysqli_query($conn, $sql);
            $check_user = mysqli_num_rows($login_query);
            // ADMIN CHECK
            $login_query2 = mysqli_query($conn, $sql2);
            $check_user2 = mysqli_num_rows($login_query2);
            
      // if there is a valid user in the db, if the results returned are one row, then log the user in, otherwise error
      // we need to create to session variables for  user so the user can log in, save details etc.

      if ($check_user == 1 && $check_user2 == 1) { //User exists and admin
      //PROFILE PICTURE CHECK
      $login_query3 = mysqli_query($conn, $sql3);
      $result = mysqli_fetch_assoc($login_query3);
      $resultstring = $result['image'];

        $_SESSION["user_login"] = $login_submit;
        $_SESSION["profile_picture"] = $resultstring;
        $_SESSION['userName'] = 'Root';
        $_SESSION['login'] = $_POST['login'];
        header("Location: main.php");

      } else if ($check_user == 1 && $check_user2 != 1) { //User exists and not admin
      //PROFILE PICTURE CHECK
      $login_query3 = mysqli_query($conn, $sql3);
      $result = mysqli_fetch_assoc($login_query3);
      $resultstring = $result['image'];

        $_SESSION["user_login"] = $login_submit;
        $_SESSION["profile_picture"] = $resultstring;
        $_SESSION['userName'] = 'User';
        $_SESSION['login'] = $_POST['login'];
        header("Location: main.php");

      } else { ?>
  <div class="alert"><span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>Accès refusé !</div>
  <?php }
    }
  }
  ?>




</body>

</html>