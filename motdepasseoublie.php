<?php
session_start();
require_once("fonctions/fonctionSQL.php");
require_once("fonctions/fonction.php"); ?>

<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Mot de passe oublié</title>
		<link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

    <?php include("header.php"); ?>

      <h1>Mot de passe oublié</h1>
  		</br></br>


      <?php if(!empty($_POST)){
        if (PseudonymeEmailMatch()) {
          if(SendMail()){
            echo 'Le mail de réinitialisation de mot de passe vous a été envoyé avec succès.';
          }
          else{
            echo 'Une erreur s\'est produite!';
          }
        }
        else{
          echo 'Les informations rentrées ne sont pas valides.';
        }
      }
      ?>



      <div style="text-align: center;">
        <div class="rectangle7">
          <div style="height:20px;"></div>
        <p class="titreboite">Réinitialisation du mot de passe :</p>
        <form action = "" method = "post">
          <p class="centrer">Votre identifiant<input type = "text" placeholder="Identifiant" name = "pseudonyme"></p>
          <p class="centrer">Votre adresse mail<input type = "text" placeholder="Email" name = "adresse_mail"></p>
          <p class="centrer"><input type = "submit" name="Envoyer" value = "Envoyer" /></p>
        </form></br>
      </div>
      </br></br></br></br>
      <img class="imageconnexion" src="IMG/Connexion.png" width="860" height="250" alt="Banière"/>
      </div>


      <?php include("footer.php"); ?>

    </body>
  </html>
