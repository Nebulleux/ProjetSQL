<?php

include("configCSS.html");
include("header.php");
include("config.php");

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
    Photo de profil : <br>
    <input type="file" name="fileToUpload" id="fileToUpload" accept="image/x-png,image/gif,image/jpeg" required/>
    <input type="submit" name="signup_submit" value="Upload">
  </form>

  <form action="signup_page2.php" class="form-container" enctype="multipart/form-data" method="POST">
  <input type="submit" name="no_pp" value="Pas de photo">
  </form>
</body>

</html>