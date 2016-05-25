<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");
require_once('JBBCode/Parser.php');

$confirmmail = connectBDD()->query('SELECT * FROM utilisateur WHERE pseudonyme = ?');
$keymail=$confirmmail['confirme'];

if(isset($_GET['titre'],$_GET['id']) AND !empty($_GET['titre']) AND !empty($_GET['id'])) {
   $get_titre = htmlspecialchars($_GET['titre']);
   $get_id = htmlspecialchars($_GET['id']);
   $titre_original = connectBDD()->prepare('SELECT sujet FROM f_topics WHERE id = ?');
   $titre_original->execute(array($get_id));
   $titre_original = $titre_original->fetch()['sujet'];
   $parser = new JBBCode\Parser();
   $parser->addCodeDefinitionSet(new JBBCode\DefaultCodeDefinitionSet());
   $parser->addBBCode("quote", '<blockquote>{param}</blockquote>');
   $parser->addBBCode("center", '<div align="center">{param}</div>');
   if($get_titre == url_custom_encode($titre_original)) {
      $topic = connectBDD()->prepare('SELECT * FROM f_topics WHERE id = ?');
      $topic->execute(array($get_id));
      $topic = $topic->fetch();
      if(isset($_POST['topic_reponse_submit'],$_POST['topic_reponse'])) {
         $reponse = htmlspecialchars($_POST['topic_reponse']);
         if(isset($_SESSION['sportsaloon'])) {
            if(!empty($reponse)) {
               $ins = connectBDD()->prepare('INSERT INTO f_messages(id_topic,id_posteur,contenu,date_heure_post) VALUES (?,?,?,NOW())');
               $ins->execute(array($get_id,$_SESSION['id'],$reponse));
               $reponse_msg = "Votre réponse a bien été postée";
               unset($reponse);
            } else {
               $reponse_msg = "Votre réponse ne peut pas être vide !";
            }
         } else {
            $reponse_msg = "Veuillez vous connecter ou créer un compte pour poster une réponse";
         }
      }
      if(isset($_GET['page']) AND $_GET['page'] > 1) {
         $reponsesParPage = 6;
      } else {
         $reponsesParPage = 5;
      }
      $reponsesTotalesReq = connectBDD()->prepare('SELECT * FROM f_messages WHERE id_topic = ?');
      $reponsesTotalesReq->execute(array($get_id));
      $reponsesTotales = $reponsesTotalesReq->rowCount();
      $pagesTotales = ceil($reponsesTotales/$reponsesParPage);
      if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
         $_GET['page'] = intval($_GET['page']);
         $pageCourante = $_GET['page'];
      } else {
         $pageCourante = 1;
      }
      $depart = ($pageCourante-1)*$reponsesParPage;
      $reponses = connectBDD()->prepare('SELECT * FROM f_messages WHERE id_topic = ? LIMIT '.$depart.','.$reponsesParPage);
      $reponses->execute(array($get_id));
   } else {
      die('Erreur: Le titre ne correspond pas à l\'id');
   }
} else {
   die('Erreur...');
}
?>



<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="forum.css" />
    <link rel="stylesheet" href="stylesheet.css">
		<title>Forum - Topic</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php"); ?>

    <h1>Topic</h1>
		</br></br>
    <div class="inscriptionetconnexion">
      <br>
  <?php  require('views/topic.view.php');?>
  <br>
</div>
  <?php include("footer.php"); ?>

</body>
</html>
