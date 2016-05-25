<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Page accueil</title>
		<link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php");?>
	<br>
	<div class="">
		<img class="imageconnexion" style="margin-top:-18px;" src="IMG/images.jpg" alt="banière" width="1440" height="482,4"/>
	</div>

<div class="">


		<h1>Bienvenue sur Sportsaloon !</h1>
		<h3>Ici, l'administrateur pourra insérer son message de propagande :p</h3><br>

	<div style="">

		<div class="inscriptionetconnexion" style="display:inline-block;width:25%;margin-left:8%">
			<p class="titreboite">Nouveautés</p>
		</div>

		<div class="inscriptionetconnexion" style="display:inline-block;width:25%">
			<p class="titreboite">Recherche</p>
		<form method="post" action="recherche_simple.php">
					<label for="departement" class="labelrecherchesimple">Département</label>
						<select name="departement" id="departement" class="selectrecherchesimple">
							<?php
							$reponse = connectBDD()->query('SELECT departement FROM groupe_sport'); //on récupère tout dans la table departement dans l'objet $reponse
							while ($donnees = $reponse->fetch()) {     // fetch --> parcourir les entrées une par une
								echo "<option>" . $donnees['departement'] . "</option>";
							}
							?>
					</select><br>
					<label for="sport" class="labelrecherchesimple">Sport du groupe</label>
					<select name="sport" id="sport" class="selectrecherchesimple">
						<?php
							$reponse = connectBDD()->query('SELECT nom_sport FROM sport');
								while ($donnees = $reponse->fetch()){
									echo "<option>" . $donnees['nom_sport'] . "</option>";
								}
							?>
					</select>
					</br>
					</br>
				 <input type="submit" value="Rechercher" class="boutonrecherchesimple ">
				</form>
		</div>

		<div class="inscriptionetconnexion" style="display:inline-block;width:25%">
			<p class="titreboite">Suggestions</p>
		</div>
	</div>



		<?php include("footer.php"); ?>
	</body>
</html>
