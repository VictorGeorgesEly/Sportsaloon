<?php
session_start();
require_once("../fonctions/fonctionSQL.php");
 if(isAdmin($_SESSION['sportsaloon']['pseudonyme'])){ ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="admin.css">
  <title>BackOfficeAccueil</title>
</head>

<body>

<nav class="menu" style="width:20%;">
  <header class="container1">
    <br>
    <a href="../index.php"><img class="imageconnexion" src="../IMG/Sportsaloon1.png" alt="" /></a>
    <div style="margin-left:25%">
      <br><br>
      <a class="boutton" href="accueil.php">&nbsp;Accueil&nbsp;</a><br><br>
      <a class="boutton" href="sports.php">&nbsp;&nbsp;Sports&nbsp;&nbsp;</a><br><br>
      <a class="boutton" href="groupes.php">&nbsp;Groupes</a><br><br>
      <a class="boutton" href="forum.php">&nbsp;&nbsp;Forum&nbsp;&nbsp;</a><br><br>
      <a class="boutton" href="reglage.php">Réglages</a><br><br>
  </div>
</nav>

<div style="margin-left:20%">

<header class="container" style="background-color:#337ab7;color:white;width:80%;position:fixed;">
  <h1 style="text-align:center;">Back-Office</h1>
</header>



</div>

</body>
</html>

<?php }
else{
  header('Location: ../404.php');
  die;
} ?>
