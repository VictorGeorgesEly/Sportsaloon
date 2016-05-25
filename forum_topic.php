<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(isset($_GET['categorie']) AND !empty($_GET['categorie'])) {
  $get_categorie = htmlspecialchars($_GET['categorie']);
  $categories = array();
  $req_categories = connectBDD()->query('SELECT * FROM f_categories');
  while($c = $req_categories->fetch()) {
     array_push($categories, array($c['id'],url_custom_encode($c['nom'])));
  }
  foreach($categories as $cat) {
     if(in_array($get_categorie, $cat)) {
        $id_categorie = intval($cat[0]);
     }
  }
  if(@$id_categorie) {
     if(isset($_GET['souscategorie']) AND !empty($_GET['souscategorie'])) {
        $get_souscategorie = htmlspecialchars($_GET['souscategorie']);
        $souscategories = array();
        $req_souscategories = connectBDD()->prepare('SELECT * FROM f_souscategories WHERE id_categorie = ?');
        $req_souscategories->execute(array($id_categorie));
        while($c = $req_souscategories->fetch()) {
           array_push($souscategories, array($c['id'],url_custom_encode($c['nom'])));
        }
        foreach($souscategories as $cat) {
           if(in_array($get_souscategorie, $cat)) {
              $id_souscategorie = intval($cat[0]);
           }
        }
     }
     $req = "SELECT *, f_topics.id topic_base_id FROM f_topics
           LEFT JOIN f_topics_categories ON f_topics.id = f_topics_categories.id_topic
           LEFT JOIN f_categories ON f_topics_categories.id_categorie = f_categories.id
           LEFT JOIN f_souscategories ON f_topics_categories.id_souscategorie = f_souscategories.id
           LEFT JOIN utilisateur ON f_topics.id_createur = utilisateur.pseudonyme
           WHERE f_categories.id = ?";

     if(@$id_souscategorie) {
        $req .= " AND f_souscategories.id = ?";
        $exec_array = array($id_categorie,$id_souscategorie);
     } else {
        $exec_array = array($id_categorie);
     }

     $req .= " ORDER BY f_topics.id DESC";

     $topics = connectBDD()->prepare($req);
     $topics->execute($exec_array);
  } else {
     die('Erreur: Catégorie introuvable...');
  }
} else {
  die('Erreur: Aucune catégorie sélectionnée...');
}

?>


<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="forum.css" />
    <link rel="stylesheet" href="stylesheet.css" />
		<title>Forum - Catégories</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php"); ?>

    <h1>Catégories</h1>
		</br></br>
    <div class="inscriptionetconnexion">
      <br>
    <?php require('views/forum_topic.view.php');?>
    <br>
  </div>

    <?php include("footer.php"); ?>

  </body>
</html>
