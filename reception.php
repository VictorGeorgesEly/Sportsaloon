<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(!isset($_SESSION['sportsaloon'])){
  require_once('404.php');
  die;
}

$msg = connectBDD()->prepare('SELECT * FROM messages WHERE id_destinataire = ?');
$msg->execute([$_SESSION['sportsaloon']['pseudonyme']]);
$msg_nbr = $msg->rowCount();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheet.css" />
    <title>Messagerie privée</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
    <?php include("header.php"); ?>
    <h1>Boite de réception</h1>
    <br><br>
    <div class="centrer">
    <a href="Messagerie.php">Nouveau message</a><br /><br /><br />
    <h3>Votre boîte de réception:</h3>
    <br>
    <div >
    <?php
    if($msg_nbr == 0) { echo "Vous n'avez aucun message..."; }
    while($m = $msg->fetch()) {
    ?>
    <b><?= $m['id_expediteur'] ?></b> vous a envoyé : <br />
    <?= nl2br($m['message']) ?><br />
    -------------------------------------<br/>
    <?php } ?>
  </div>
  </div>
    <?php include("footer.php"); ?>
  </body>
</html>
