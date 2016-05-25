<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");
require_once("JBBCode/Parser.php");

$confirmmail = connectBDD()->query('SELECT * FROM utilisateur WHERE pseudonyme = ?');
$keymail=$confirmmail['confirme'];


if(isset($_GET['categorie'])) {
   $get_categorie = htmlspecialchars($_GET['categorie']);
   $categorie = connectBDD()->prepare('SELECT * FROM f_categories WHERE id = ?');
   $categorie->execute(array($get_categorie));
   $cat_exist = $categorie->rowCount();
   if($cat_exist == 1) {
      $categorie = $categorie->fetch();
      $categorie = $categorie['nom'];
      $souscategories = connectBDD()->prepare('SELECT * FROM f_souscategories WHERE id_categorie = ? ORDER BY nom');
      $souscategories->execute(array($get_categorie));
      if(isset($_SESSION['sportsaloon'])) {
         if(isset($_POST['tsubmit'])) {
            if(isset($_POST['tsujet'],$_POST['tcontenu'])) {
               $sujet = htmlspecialchars($_POST['tsujet']);
               $contenu = htmlspecialchars($_POST['tcontenu']);
               $contenu = utf8_encode($contenu);
               $contenu = str_replace('ï»¿','',$contenu);
               $contenu = utf8_decode($contenu);

               $souscategorie = htmlspecialchars($_POST['souscategorie']);
               $verify_sc = connectBDD()->prepare('SELECT id FROM f_souscategories WHERE id = ? AND id_categorie = ?');
               $verify_sc->execute(array($souscategorie,$get_categorie));
               $verify_sc = $verify_sc->rowCount();
               if($verify_sc == 1) {
                  if(!empty($sujet) AND !empty($contenu)) {
                     if(strlen($sujet) <= 70) {
                        if(isset($_POST['tmail'])) {
                           $notif_mail = 1;
                        } else {
                           $notif_mail = 0;
                        }
                        $ins = connectBDD()->prepare('INSERT INTO f_topics (id_createur, sujet, contenu, notif_createur, date_heure_creation) VALUES(?,?,?,?,NOW())');
                        $ins->execute(array($_SESSION['id'],$sujet,$contenu,$notif_mail));

                        $lt = connectBDD()->query('SELECT id FROM f_topics ORDER BY id DESC LIMIT 0,1');
                        $lt = $lt->fetch();
                        $id_topic = $lt['id'];
                        $ins = connectBDD()->prepare('INSERT INTO f_topics_categories (id_topic, id_categorie, id_souscategorie) VALUES (?,?,?)');
                        $ins->execute(array($id_topic, $get_categorie, $souscategorie));
                     } else {
                        $terror = "Votre sujet ne peut pas dépasser 70 caractères";
                     }
                  } else {
                     $terror = "Veuillez compléter tous les champs";
                  }
               } else {
                  $terror = "Sous-catégorie invalide";
               }
            }
         }
      } else {
         $terror = "Veuillez vous connecter pour poster un nouveau topic";
      }
   } else {
      die('Catégorie invalide...');
   }
} else {
   die('Aucune catégorie définie...');
}

?>

<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="forum.css" />
		<title>Forum - Nouveau topic</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php"); ?>

    <h1>Nouveau topic</h1>
		</br></br>

    <?php require('views/nouveau_topic.view.php');

    include("footer.php"); ?>

	</body>
</html>
