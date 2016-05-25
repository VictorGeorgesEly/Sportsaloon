<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(isset($_SESSION['sportsaloon'])){
  require_once('inscription.php');
  die;
}?>

<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Connexion</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php"); ?>

<br><br>

		<?php if(isset($_POST['formconnexion'])){
			$pseudonyme = htmlspecialchars($_POST['pseudonyme']);
			$password = sha1($_POST['mot_de_passe']);
			if(!empty($_POST['pseudonyme']) AND !empty($_POST['mot_de_passe'])){
				$data = Connexion($pseudonyme); //penser à l'interface back-office de l'administrateur
				if($data){
					$_SESSION['sportsaloon']=$data;
          $_SESSION['id']=$pseudonyme;
					header('Location: index.php');
				}
				else{
					echo "Les informations rentrées ne sont pas valides.";
				}
			}
		}
		?>

		<div style="text-align: center;">
			<div class="inscriptionetconnexion" style="display:inline-block;">
				<div style="height:10px;"></div>
				<p class="titreboite" style="padding-bottom:23px;">Connexion</p>
				<form action = "" method = "post" >
	  			<p class="centrer"><label for="identifiant1">Votre identifiant</label><input class="form-control" type = "text" id="identifiant1" placeholder="Identifiant" name = "pseudonyme" value="<?php if(isset($pseudonyme)) {echo $pseudonyme; } ?>"></p>
	  	    <p class="centrer"><label for="mdp1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Votre mot de passe&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input class="form-control" type = "password" id="mdp1" placeholder="Mot de passe" name = "mot_de_passe"></p>
          <a href="motdepasseoublie.php" class="">Mot de passe oublié ?</a>
	  	    <p class="centrer "><input class="boutton" type = "submit" name="formconnexion" value = "Connexion" /></p>

	    	</form></br>
			</div>

		<?php if(isset($_POST['forminscription'])){
			$pseudonyme=htmlspecialchars($_POST['pseudonyme']);
			$mot_de_passe=$_POST['mot_de_passe'];
			$mot_de_passebis=$_POST['mot_de_passebis'];
			if(!empty($_POST['pseudonyme']) AND !empty($_POST['mot_de_passebis']) AND !empty($_POST['mot_de_passe'])){
				$pseudolenght = strlen(htmlspecialchars($_POST['pseudonyme']));
				if ($pseudolenght <= 45){
					if ($mot_de_passe == $mot_de_passebis){
						if(!pseudonymefree($pseudonyme)){
							Inscription($pseudonyme);
							$_SESSION['sportsaloon']=$pseudonyme;
              $_SESSION['id']=$pseudonyme;
							header('Location: inscription.php');
						}
						else{
							$erreur = 'Ce pseudonyme est déjà utilisé.';
						}
					}
					else{
						$erreur = 'Les deux mots de passe ne sont pas identiques';
					}
				}
				else{
					$erreur = "Votre pseudo ne doit pas dépasser 45 caractères";
				}
			}
			else{
				$erreur = "Tous les champs doivent être complétés";
			}
		}?>

		<div class="inscriptionetconnexion" style="display:inline-block">
			<p class="titreboite">Inscription</p>
			<form method = "post">
				<p class="centrer"><label for="identifiant">Votre identifiant</label><input class="form-control" type = "text" placeholder="Identifiant" id="identifiant" name = "pseudonyme" value="<?php if(isset($pseudonyme)) {echo $pseudonyme; } ?>"/></p>
				<p class="centrer"><label for="motdepasse1">Votre mot de passe</label><input class="form-control" type = "password" placeholder="Mot de passe" id="motdepasse1" name="mot_de_passe"></code></p>
				<p class="centrer"><label for="motdepasse">Confirmation du mot de passe</label><input class="form-control" type = "password" placeholder="Confirmation du mot de passe" id="motdepasse" name="mot_de_passebis"/></p>
				<p class="centrer"><input type = "submit" name="forminscription" class="boutton" value = "Inscription" /></p>
			</form>
				<?php
					if(isset($erreur)){
						echo($erreur);
					}
				 ?>

		    </br>
		  </div>
		  </br></br></br></br>
			<img class="imageconnexion" src="IMG/Connexion.png" width="860" height="250" alt="Banière"/>
	    </div>

		<?php include("footer.php"); ?>

	</body>
</html>
