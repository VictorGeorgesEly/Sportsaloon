<?php
  session_start();
  require_once("fonctions/fonctionSQL.php");

  if(isset($_GET['pseudonyme'], $_GET['key']) AND !empty($_GET['pseudonyme']) AND !empty($_GET['key'])){
    $pseudonyme = htmlspecialchars(urldecode($_GET['pseudonyme']));
    $key = intval($_GET['key']);
    $requser = connectBDD()->prepare("SELECT * FROM utilisateur WHERE pseudonyme = ? AND confirmkey = ?");
    $requser->execute([$pseudonyme,$key]);
    $userexist = $requser->rowcount();

    if($userexist ==1){
      $user = $requser->fetch();
      if($user['confirme'] == 0){
        $update = connectBDD()->prepare("UPDATE utilisateur SET confirme = 1 WHERE pseudonyme = ? AND confirmkey = ?");
        $update->execute([$pseudonyme,$key]);
        echo "Votre compte à bien été confirmé !";
      }
      else{
        echo "Votre compte à déjà été confirmé !";
      }
    }
    else{
      echo "l'Utilisateur n'existe pas !";
    }
  }
 ?>
