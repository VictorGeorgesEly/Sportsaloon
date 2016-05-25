<?php
session_start();
require_once("fonctions/fonctionSQL.php");
require_once("fonctions/fonction.php");
 ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<link rel="stylesheet" href="stylesheet.css" />
    <title>Groupe</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
    <?php include("header.php");?>
    <br><br>
    <div class="groupe" style="width:80%;text-align:center">
      <img src="IMG/images.jpg" alt="Nature" style="width:100%"/>
      <div class="coutainer padding-8">
        <h3><b>Titre groupe</b></h3>
        <h5>Title description, <span style="opacity:0.60">April 7, 2014</span></h5>
      </div>
      <div class="coutainer">
        <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
          tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>


          <?php $links=array(); Calendrier($mois, $année, $links); ?>


      </div>
    </div>
    <?php include("footer.php"); ?>
  </body>
</html>
