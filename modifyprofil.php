<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(!isset($_SESSION['sportsaloon'])){
  require_once('404.php');
  die;
}

   $requser = connectBDD()->prepare("SELECT * FROM utilisateur WHERE pseudonyme = ?");
   $requser->execute([$_SESSION['sportsaloon']['pseudonyme']]);
   $user = $requser->fetch();

   $pseudonyme=$_SESSION['sportsaloon']['pseudonyme'];
   $idutilisateur=$_SESSION['sportsaloon']['idutilisateur'];

   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudonyme']) {
      Updatepseudo($pseudonyme);
      $_SESSION['sportsaloon']=Updatepseudonyme($idutilisateur);
      header('Location: profil.php');
   }

   if(isset($_POST['adresse_mail']) AND !empty($_POST['adresse_mail']) AND $_POST['adresse_mail'] != $user['adresse_mail']) {
      Updatemail($pseudonyme);
      $_SESSION['sportsaloon']=updateadressemail($pseudonyme);
      header('Location: profil.php');
   }

   if(isset($_POST['mot_de_passe']) AND !empty($_POST['mot_de_passe']) AND isset($_POST['mdp_verification']) AND !empty($_POST['mdp_verification'])) {
      if($_POST['mot_de_passe']==$_POST['mdp_verification']) {
        UpdateMDP1($pseudonyme);
        $_SESSION['sportsaloon']=update_mdp($pseudonyme);
         header('Location: profil.php');
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }

   if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
     $taillemax=2097152;
     $extensionsvalides=array('jpg','jpeg','gif','png');
     if($_FILES['avatar']['size'] <= $taillemax){
       $extensionupload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1)); // check si tout minuscule et l'extension
       if(in_array($extensionupload, $extensionsvalides)){
         $chemin = "IMG/avatar/".$_SESSION['id'].".".$extensionupload;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin); //stockage temporaire
         if($resultat){
           $updateavatar = connectBDD()->prepare('UPDATE utilisateur SET avatar = :avatar WHERE pseudonyme = :pseudonyme');
           $updateavatar -> execute(array(
             'avatar' => $_SESSION['id'].".".$extensionupload,
             'pseudonyme' => $_SESSION['id']
           ));
           header('Location: profil.php');
         }
         else{
           $msg = "Erreur lors de l'importation de la photo de profil...";
         }
       }
       else{
         $msg = "Votre photo de profil doit être au format indiqué !";
       }
     }
     else{
       $msg = "Votre photo de profil ne doit pas dépasser 2 Mo !";
     }
   }
?>
<html>
  <head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="stylesheet.css" />
    <title>profil</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
  <?php include("header.php"); ?>
  <br>

<h2 class="centrer">Edition de mon profil</h2>
  <div class="centrer"  style="padding-left:15%">

   <br>
    <div class="inscriptionetconnexion"style="width:80%">
      <form method="POST" action="" enctype="multipart/form-data"> <!-- Encodage pour fichier -->
         <label>Pseudo :</label>
         <input class="form-control" type="text" name="newpseudo" placeholder="<?php echo $_SESSION['sportsaloon']['pseudonyme'] ?>" value="<?php //echo $user['pseudonyme']; ?>" /><br /><br />
         <label>Mail :</label>
         <input class="form-control" type="text" name="adresse_mail" placeholder="<?php echo $_SESSION['sportsaloon']['adresse_mail'] ?>" value="<?php //echo $user['adresse_mail']; ?>" /><br /><br />
         <label>Mot de passe :</label>
         <input class="form-control" type="password" name="mot_de_passe" placeholder="Mot de passe"/><br /><br />
         <label>Confirmation - mot de passe :</label>
         <input class="form-control" type="password" name="mdp_verification" placeholder="Confirmation du mot de passe" /><br /><br />
         <label for="">Avatar :</label>
         <input type="file" name="avatar"><br><br>
         <input type="submit" class="boutton" value="Mettre à jour mon profil !" />
      </form>

    </div>
      <?php if(isset($msg)) { echo $msg; } ?>
</div>

  <?php include("footer.php"); ?>

  </body>
</html>
