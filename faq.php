<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheet.css" />
    <title>FAQ</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>
  <body>
    <?php include("header.php"); ?>
<br><br>

<div class="groupe" style="width:80%;text-align:center">
  <div class="container padding-8">
    <h3><b>Question 1</b></h3>
  </div>

  <div class="container">
    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
      tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    <div class="">
      <div >
        <p><button class="boutton"><b>READ MORE »</b></button></p>
      </div>
    </div>
  </div>
</div>
<br>

<div style="width:80%;padding-left:10%">
  <hr>
</div>


<br>
<div class="groupe" style="width:80%;text-align:center">
  <div class="container padding-8">
    <h3><b>Question 2</b></h3>
  </div>

  <div class="container">
    <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at. Phasellus sed ultricies mi non congue ullam corper. Praesent tincidunt sed
      tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla.</p>
    <div class="">
      <div >
        <p><button class="boutton"><b>READ MORE »</b></button></p>
      </div>
    </div>
  </div>
</div>
<br>

    <?php include("footer.php"); ?>
  </body>
</html>
