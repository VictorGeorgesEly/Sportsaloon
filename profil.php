<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(!isset($_SESSION['sportsaloon'])){
  require_once('404.php');
  die;
}

$getid = intval($_SESSION['sportsaloon']['idutilisateur']);
$requser = connectBDD()->prepare('SELECT * FROM utilisateur WHERE idutilisateur = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();

?>
<html>
  <head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="stylesheet.css" />
    <title>profil</title>
  </head>
  <body>
  <?php include("header.php"); ?>
  <br>

  <div class="centrer">
    Profil de <?php echo $_SESSION['sportsaloon']['pseudonyme']; ?>
    <br>
    mail = <?php echo $_SESSION['sportsaloon']['adresse_mail'] ?>
    <br>
    <?php
    if (!empty($userinfo['avatar'])){ ?>
      <img src="IMG/avatar/<?php echo $userinfo['avatar'];?>" alt="avatar" width="150" />
    <?php
    } ?>
    <br><br>
    ville = <?php echo $_SESSION['sportsaloon']['ville'] ?>
    <br>
    date de naissance = <?php echo $_SESSION['sportsaloon']['jour'] ?>/<?php echo $_SESSION['sportsaloon']['mois'] ?>/<?php echo $_SESSION['sportsaloon']['annee'] ?>
    <br>
    Âge = <?php echo $_SESSION['sportsaloon']['age'] ?>
    <br>
    Région = <?php echo $_SESSION['sportsaloon']['region'] ?>
    <br>
    Nom = <?php echo $_SESSION['sportsaloon']['nom'] ?>
    <br>
    Prenom = <?php echo $_SESSION['sportsaloon']['prenom'] ?>
    <br>
    Code Postal = <?php echo $_SESSION['sportsaloon']['codepostal'] ?>
    <br>
    Adresse = <?php echo $_SESSION['sportsaloon']['adresse'] ?>
    <br>
    Pays = <?php echo $_SESSION['sportsaloon']['pays'] ?>
    <br>
    <a href="modifyprofil.php">Modifier votre profil</a>
  </div>



<?php include("footer.php"); ?>

</body>
</html>
