<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

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


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Groupe <?= $resultat['nom_groupe'] ?></title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
    <link rel="stylesheet" href="stylesheet.css" />
  </head>
  <body>
    <?php include("header.php");?>
    <br><br>
    SYSTEME D'ALERTE SI PLACE SE LIBERT DANS GROUPE <br>
    PARTAGE GROUPE SUR RESEAU SOCIAUX <br>
    COMMENTER UN CLUB ET NOTER CLUB <br>
    VISUALISER LE PLANNING D'UNE PERSONNE <br>
    ADMIN GROUPE GERER MEMBRES <br>
    LEGUER LES DROIT A UN AUTRE MEMBRE
    <div class="groupe" style="width:80%;">
    <img src="IMG/images.jpg" alt="Nature" style="width:100%">
      <div class="container padding-8">
        <h3><b><?= $resultat['nom_groupe'] ?></b></h3>
        <h5 style="text-align:center">Title description, <span style="opacity:0.60">April 7, 2014</span></h5>
      </div>
      <div class="container">
        <p style="text-align:center"><?= $resultat['description'] ?></p>
        <div>
          <br><br>
        <div style="margin-left:8%">
          <div class="container" style="width:40%;display:inline-block;">
            <div class="groupe">
              <img src="IMG/images.jpg" alt="Nature" style="width:100%">
              <div class="container padding-10">
                <p style="text-align:center"><b>Club</b></p>
                <h5 style="text-align:center">Title description, <span style="opacity:0.60">April 7, 2014</span></h5>
              </div>
              <div class="container">
                <p style="text-align:center">Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
                  tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
              </div>
            </div>
          </div>
          <div class="container" style="width:40%;display:inline-block;">
            <div class="groupe">
              <img src="IMG/images.jpg" alt="Nature" style="width:100%">
              <div class="container padding-10">
                <p style="text-align:center"><b>Titre évènement</b></p>
                <h5 style="text-align:center">Title description, <span style="opacity:0.60">April 7, 2014</span></h5>
              </div>
              <div class="container">
                <p style="text-align:center">Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
                  tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div style="text-align:center">
          <p><a href=groupea.php><button class="boutton">S'inscrire au groupe »</button></a></p>
        </div>
        </div>
      </div>
    </div>
    <a href="modifiergroupe.php?nom_groupe=<?= url_custom_encode($nom_groupe) ?>" class="back-to-top boutton ">Modifier le groupe</a>
    <a href="modifierevenement.php?nom_groupe=<?= url_custom_encode($nom_groupe) ?>" class="back-to-top boutton" style="bottom:63%">Modifier un évènement</a>
    <a href="évènement.php?nom_groupe=<?= url_custom_encode($nom_groupe) ?>" class="back-to-top boutton" style="bottom:51%">Créer un évènement</a>
    <?php include("footer.php");?>
  </body>
</html>
