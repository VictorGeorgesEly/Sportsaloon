<?php session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(isset($_GET['token'])){
  if(!TokenExists()){
    header('Location: 404.php');
  }
  else{
    if($_POST['mot_de_passe']!=''){
      if($_POST['mot_de_passe']==$_POST['mdp_verification']){
        $pseudonyme=TokenExists()['pseudonyme'];
        UpdateMDP($pseudonyme);
        header('Location: index.php?reinitialise=true');
      }
    }
  }
}
?>


<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Réinitialiser le mot de passe</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

    <?php include("header.php"); ?>

      <h3>Réinitialiser le mot de passe</h3>
  		</br></br>

      <div style="text-align: center;">
        <div class="rectangle">
          <div style="height:20px;"></div>
        <p class="titreboite">Réinitialisation du mot de passe :</p>
        <form action = "" method = "post">
          <p class="centrer">Mot de passe<input type = "password" placeholder="Mot de passe" name = "mot_de_passe"></p>
          <p class="centrer">Confirmation du mot de passe<input type = "password" placeholder="Confirmation du mot de passe" name = "mdp_verification"></p>
          <p class="centrer"><input type = "submit" name="Envoyer" value = "Envoyer" /></p>
        </form></br>
      </div>

            <?php
            if($_POST['mot_de_passe']!=''){
              if($_POST['mot_de_passe']!=$_POST['mdp_verification']){
                echo 'Les deux mots de passe ne concordent pas.';
              }
            }
            ?>



</br></br></br></br>
<img class="imageconnexion" src="IMG/Connexion.png" width="860" height="250" alt="Banière"/>
</div>


<?php include("footer.php"); ?>

</body>
</html>
