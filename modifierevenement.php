<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");
require_once("Calendrier(JavaScript).php");


if(isset($_GET['nom_groupe']) AND !empty($_GET['nom_groupe'])) {
  $nom_groupe=htmlspecialchars($_GET['nom_groupe']);
  $groupes = array();
  $req_groupes = connectBDD()->query('SELECT * FROM groupe_sport');

  $sql="SELECT * FROM groupe_sport WHERE nom_groupe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$nom_groupe]);
  $resultat=$query->fetch();
}
else {
  die('Erreur: Aucun groupe sélectionné...');
}
 ?>


 <?php
 if (isset($_POST['Enregistrer'])){
   evenement();
   echo "Evenement bien enregistré";
  $nom=htmlspecialchars($_POST['nom_evenement']);
   $sql="SELECT id_evenement FROM evenement WHERE nom_evenement=?";
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
         $chemin = "IMG/evenement/".$coucou.".".$extensionupload;
         $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin); //stockage temporaire
         if($resultat){
           $updateavatar = connectBDD()->prepare('UPDATE evenement SET avatar = :avatar WHERE id_evenement = :id_evenement');
           $updateavatar -> execute(array(
             'avatar' => $coucou.".".$extensionupload,
             'id_evenement' => $coucou
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
   }
 }

  ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" href="stylesheet.css" />
    <title>Évènements</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
    <?php include("header.php");?>
    <br><br>

    <form method = "post" enctype="multipart/form-data">
        <div class="groupe" style="width:80%;text-align:center">
          <div class="container">
            <p>Nom de l'évènement :</p>
            <input class="form-control" style="width:20%" type="text" id="nom_evenement" name="nom_evenement">
            <p>Type de sport :</p>
            <select class="selectschrool" name="sport">
                <option value="1">Sportif</option>
                <option value="2">Club</option>
            </select>
            <p>Nombre de place :</p>
            <select class="selectschrool" name=nb_place size=1>
              <option value=place selected>Places</option>
              <?php
              $nombre1=1;
              while ($nombre1 <= 50){ ?>
              <option value="<?php echo $nombre1 ?>"><?php echo $nombre1 ?></option>
              <?php $nombre1=$nombre1; $nombre1++;} ?>
            </select>
            <br>
            <br>

            <label for="">Avatar :</label>
            <input type="file" name="avatar"><br><br>

            <p>Décrire l'évènement en quelques lignes (500 caractères max.) :</p>
            <textarea class="form-control1" name="descri" rows="8" cols="55"></textarea>
            <br>
            <br>
            <h4>Localisation</h4>
            <table style="background-color:white">
                <tr>
                    <td>Code postal :</td>
                    <td><input class="form-control" style="width:40%" type="text" id="postal" name="postal"></td>
                    <td>Adresse :</td>
                    <td><input class="form-control" style="width:40%" type="text" id="adresse" name="adresse"></td>
                </tr>

                <tr>
                    <td>Ville :</td>
                    <td><input class="form-control" style="width:40%" type="text" id="ville" name="ville"></td>
                    <td>Pays :</td>
                    <td><select class="selectschrool" name="pays" style="width: 106px;">
                            <option value="Belgique">Belgique</option>
                            <option value="France" selected="selected">France</option>
                            <option value="Suisse">Suisse</option>
                        </select></td>
                </tr>
            </table>
            <br>
            <br>
            <h4>Date</h4>
            <table style="background-color:white">
                <tr>
                    <td>Début :</td>
                    <td><input class="calendrier" type="text" id="date" name="date_debut" style="width: 100px; margin-left: 5px;"></td>
                    <td>Heure :</td>
                    <td><select class="selectschrool" name="heure_d">
                            <option value="heure1">9h00</option>
                            <option value="heure2">10h00</option>
                            <option value="heure3">11h00</option>
                            <option value="heure4">12h00</option>
                            <option value="heure5">13h00</option>
                            <option value="heure6">14h00</option>
                            <option value="heure7">15h00</option>
                            <option value="heure8">16h00</option>
                            <option value="heure9">17h00</option>
                            <option value="heure10">18h00</option>
                            <option value="heure11">19h00</option>
                            <option value="heure12">20h00</option>
                            <option value="heure13">21h00</option>
                            <option value="heure14">22h00</option>
                            <option value="heure15">23h00</option>
                        </select></td>
                    <td>Minutes :</td>
                    <td><select class="selectschrool" name="min_d">
                            <option value="min1">00</option>
                            <option value="min2">15</option>
                            <option value="min3">30</option>
                            <option value="min4">45</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Fin :</td>
                    <td><input class="calendrier" type="text" id="date" name="date_f" style="width: 100px; margin-left: 5px;"></td>
                    <td>Heure :</td>
                    <td><select class="selectschrool" name="heure_f">
                            <option value="heure1">9h00</option>
                            <option value="heure2">10h00</option>
                            <option value="heure3">11h00</option>
                            <option value="heure4">12h00</option>
                            <option value="heure5">13h00</option>
                            <option value="heure6">14h00</option>
                            <option value="heure7">15h00</option>
                            <option value="heure8">16h00</option>
                            <option value="heure9">17h00</option>
                            <option value="heure10">18h00</option>
                            <option value="heure11">19h00</option>
                            <option value="heure12">20h00</option>
                            <option value="heure13">21h00</option>
                            <option value="heure14">22h00</option>
                            <option value="heure15">23h00</option>
                        </select></td>
                    <td>Minutes :</td>
                    <td><select class="selectschrool" name="min_f">
                            <option value="min1">00</option>
                            <option value="min2">15</option>
                            <option value="min3">30</option>
                            <option value="min4">45</option>
                        </select></td>
                </tr>
            </table>
            <div >
              <p class="centrer"><input type = "submit" name="Enregistrer" class="boutton" value = "Valider »" /></p>
            </div>
            </div>
        </div>
    </form>
    <?php include("footer.php"); ?>
  </body>
</html>
