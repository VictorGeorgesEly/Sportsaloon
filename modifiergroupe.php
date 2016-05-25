<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");
 ?>

 <?php
 if(isset($_GET['nom_groupe']) AND !empty($_GET['nom_groupe'])) {
   $nom_groupe=htmlspecialchars($_GET['nom_groupe']);
   $groupes = array();
   $req_groupes = connectBDD()->query('SELECT * FROM groupe_sport');

   $sql="SELECT * FROM groupe_sport WHERE nom_groupe=?";
   $query=connectBDD()->prepare($sql);
   $query->execute([$nom_groupe]);
   $resultat1=$query->fetch();
 }
 else {
   die('Erreur: Aucun groupe sélectionné...');
 }
  ?>


 <?php
 if (isset($_POST['Enregistrer'])){
   $nom1=htmlspecialchars($_GET['nom_groupe']);
   $sql1="SELECT id_groupe FROM groupe_sport WHERE nom_groupe=?";
   $query1=connectBDD()->prepare($sql1);
   $query1->execute([$nom1]);
   $id_groupe=$query1->fetch();
   $id_groupe=$id_groupe[0];
   if(isset($_POST['new_nom_groupe']) AND !empty($_POST['new_nom_groupe']) AND $_POST['new_nom_groupe'] != $resultat1['nom_groupe']) {
      Updatepnomgroupe($id_groupe);
      echo "Le nom du groupe a bien été changé !!";
   }
   if(isset($_POST['new_sport']) AND !empty($_POST['new_sport']) AND $_POST['new_sport'] != $resultat1['sport']) {
      Updatepsport($id_groupe);
      echo "Le sport du groupe à bien été changé !!";
    }
    if(isset($_POST['new_club']) AND !empty($_POST['new_club']) AND $_POST['new_club'] != $resultat1['club']) {
       Updatepclub($id_groupe);
       echo "Le club du groupe à bien été changé !!";
     }

   /*$nom=htmlspecialchars($_POST['nom_groupe']);
   $sql="SELECT id_groupe FROM groupe_sport WHERE nom_groupe=?";
   $query=connectBDD()->prepare($sql);
   $query->execute([$nom]);
   $id_photo=$query->fetch();
   $coucou=$id_photo['0'];
   if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
     $taillemax=2097152;
     $extensionsvalides=array('jpg','jpeg','gif','png');
     if($_FILES['avatar']['size'] <= $taillemax){
       $extensionupload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1)); // check si tout minuscule et l'extension
       if(in_array($extensionupload, $extensionsvalides)){
         $chemin = "IMG/groupe/".$coucou.".".$extensionupload;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin); //stockage temporaire
         if($resultat){
           $updateavatar = connectBDD()->prepare('UPDATE groupe_sport SET avatar = :avatar WHERE id_groupe = :id_groupe');
           $updateavatar -> execute(array(
             'avatar' => $coucou.".".$extensionupload,
             'id_groupe' => $coucou
           ));
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
   }*/
 }

  ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Modifier groupe</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
    <link rel="stylesheet" href="stylesheet.css" />
  </head>
  <body>
    <?php include("header.php");?>
    <br><br>
    <div class="groupe" style="width:80%;text-align:center">
      <form class="container" action="" method="post" enctype="multipart/form-data">
        <label for="Nom">Nom du groupe</label><br>
        <input type="text" name="new_nom_groupe" placeholder="<?php echo $resultat1['nom_groupe'] ?>" id="Nom" class="form-control" style="width:20%"><br>
        <label for="sport">Sport</label><br>
        <select class="selectschrool" name="new_sport">
          <option value="1">Foot</option>
          <option value="2">Natation</option>
        </select><br>
        <label for="club">Club</label><br>
        <select class="selectschrool" name="new_club">
          <option value="1">Club1</option>
          <option value="2">club2</option>
        </select><br>
        <label for="nbplace">Nombre de places</label><br>
        <select class="selectschrool" name="new_nombre_participant_max">
          <?php
          $nombre1=1;
          while ($nombre1 <= 50){ ?>
          <option value="<?php echo $nombre1 ?>"><?php echo $nombre1 ?></option>
          <?php $nombre1=$nombre1; $nombre1++;} ?>
        </select><br>
        <label for="description">Description</label><br>
        <textarea type="text" name="new_description" placeholder="<?php echo $resultat1['description'] ?>" id="description" class="form-control1" ></textarea><br>
        <label for="">Image du groupe :</label><br>
        <input type="file" name="avatar"><br>
        <div >
          <p class="centrer"><input type = "submit" name="Enregistrer" class="boutton" value = "Modifier »" /></p>
        </div>
      </form>

    </div>
  <?php include("footer.php");?>
  </body>
</html>
