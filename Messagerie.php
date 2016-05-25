<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(!isset($_SESSION['sportsaloon'])){
  require_once('404.php');
  die;
}

  if(isset($_POST['formmessage'])){
    if(isset($_POST['destinataire'],$_POST['message']) AND !empty($_POST['destinataire']) AND !empty($_POST['message'])){
      $destinataire = htmlspecialchars($_POST['destinataire']);
      $message = htmlspecialchars($_POST['message']);

      $id_destinataire = connectBDD()->prepare('SELECT pseudonyme FROM utilisateur WHERE pseudonyme=?');
      $id_destinataire->execute([$destinataire]);
      $id_destinataire = $id_destinataire->fetch();
      $id_destinataire = $id_destinataire['pseudonyme'];

      $ins=connectBDD()->prepare("INSERT INTO messages (id_expediteur,id_destinataire,message) VALUES (?,?,?)");
      $ins->execute([$_SESSION['sportsaloon']['pseudonyme'],$id_destinataire,$message]);

      $error = "Votre message a bien été envoyé !";
    }
    else{
      $error="Veuillez compléter tous les champs";
    }
  }

$destinataires = connectBDD()->query('SELECT pseudonyme FROM utilisateur ORDER BY pseudonyme'); //mettre dans fonctionSQL

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
    <h1>Boite d'envoie</h1>
    <br><br>
    <form class="inscriptionetconnexion" action="#" method="post">
      <label for="">Destinaire :</label>
      <select class="selectschrool" name="destinataire">
        <?php while($d = $destinataires->fetch()) {?>
          <option><?php echo $d['pseudonyme'] ?></option>
          <?php } ?>
      </select>
      <br><br>
      <textarea name="message" class="form-control1" placeholder="Votre message"></textarea>
      <br>
      <input type="submit"  class="boutton" name="formmessage" value="Envoyer">
      <br>
      <?php if(isset($error)){ echo '<span style="color:red">' .$error.'</span>';} ?>
      <br>
      <a class="boutton" href="reception.php">Boite de réception</a>
    </form>
  <?php include("footer.php"); ?>
  </body>
</html>
