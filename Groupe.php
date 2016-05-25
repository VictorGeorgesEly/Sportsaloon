<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");


$groupes = connectBDD()->query('SELECT * FROM groupe_sport ORDER BY nom_groupe');
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" href="stylesheet.css" />
    <title>Groupes de sport</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
    <?php include("header.php");?>
    <br><br>

    <?php
    while($c = $groupes->fetch()) {
    ?>

		  <div class="groupe" style="width:80%;text-align:center">
		  <img src="IMG/groupe/<?php if ($c['avatar']!=NULL){echo $c['avatar'];} else{ echo "images.jpg";} ?>" alt="Image groupe" style="width:100%">
		    <div class="container padding-8">
		      <h3><b><?= $c['nom_groupe'] ?></b></h3>
		      <h5>Title description, <span style="opacity:0.60">April 7, 2014</span></h5>
		    </div>

		    <div class="container">
		      <p><?= $c['description'] ?></p>
		      <div class="">
		        <div >
		          <p><a href="groupea.php?nom_groupe=<?= url_custom_encode($c['nom_groupe']) ?>"><button class="boutton">Pour en savoir plus »</button></a></p>
		        </div>
		      </div>
		    </div>
		  </div>
      <br>
		  <div style="width:80%;padding-left:10%">
		    <hr>
		  </div>
      <br>
      <?php } ?>
		  <div class="groupe" style="width:80%;text-align:center">
		  <img src="IMG/images.jpg" alt="Norway" style="width:100%">
		    <div class="container padding-8">
		      <h3><b>BLOG ENTRY</b></h3>
		      <h5>Title description, <span style="opacity:0.60">April 2, 2014</span></h5>
		    </div>

		    <div class="container">
		      <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
		        tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
		      <div >
		        <div >
		          <p><a href=groupea.php><button class="boutton">Pour en savoir plus »</button></a></p>
		        </div>
		      </div>
		    </div>
		  </div>
      <a href="creergroupe.php" class="back-to-top boutton">Créer un groupe</a>

    <?php include("footer.php"); ?>

  </body>
</html>
