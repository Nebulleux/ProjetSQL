<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "db_3d";
    $conn = mysqli_connect($servername, $username, $password,$db);
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }
?>