<?php
session_start();
require_once("fonctions/fonctionSQL.php");
require_once("fonctions/fonction.php"); ?>

<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Contact</title>
		<link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>
  <?php include("header.php"); ?>
		<h1> Contact </h1>

		<?php
		if(isset($_POST['mailform']))
		{
			if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['message']))
			{
				if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
    		{
					if(SendMail1()){
						$msg="Votre message a bien été envoyé !";
					}
				}
				else{
					$msg="L'adresse mail n'est pas valide";
				}
			}
			else
			{
				$msg="Tous les champs doivent être complétés !";
			}
		}
		?>


		<div id="googleMap" style="height:400px;filter: grayscale(90%);-webkit-filter: grayscale(90%);"></div>
		<script src="http://maps.googleapis.com/maps/api/js"></script>
		<script>
		var myCenter = new google.maps.LatLng(48.845388, 2.328140);

		function initialize() {
		var mapProp = {
		center:myCenter,
		zoom:15,
		scrollwheel:false,
		draggable:false,
		mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker = new google.maps.Marker({
		position:myCenter,
		});

		marker.setMap(map);
		}

		google.maps.event.addDomListener(window, 'load', initialize);
		</script>

<br>
		<div style=text-align:center;>
				<div class="inscriptionetconnexion" style="display:inline-block;">
						<p class="titreboite">Bureau</p>
						<p class="centrer">28, rue Notre Dame des Champs</p>
						<p class="centrer">75 006, PARIS</p>
						<p class="centrer">Métro Notre Dame des champs</p>
						<p class="centrer">Métro Saint Placide</p>
						<span class="adresse"> Tel:</span> <a href="tel:01 42 23 78 12"> 01 42 23 78 12</a></br></br>
						<span class="adresse"> Email: </span> <a href="mailto:sportsaloon@gmail.com"> sportsaloon@gmail.com</a></br><br><br>
					</div>
			</div>
<br><br><br>

			<div style="text-align:center; padding-left: 32%;">
				<div class="inscriptionetconnexion" style="width:50%" >
				<h3>Contact</h3>
					<form action = "" method = "post">
						<p>Merci de bien vouloir renseigner le formulaire ci-après, nous nous engageons à vous rappeller dans les 24 heures. </p>


						Civilité *:<br>
						<input class="w3-radio" type="radio" name="feminin" value="Monsieur" checked>
						<label class="w3-validate">Homme</label></p>

						<input class="w3-radio" type="radio" name="feminin" value="Madame">
						<label class="w3-validate">Femme</label></p>


						<br><br>
						<input class="form-control" type="text" name="nom" placeholder="Votre nom" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" /><br /><br />
						<input class="form-control" type="text" name="prenom" placeholder="Votre prénom" value="<?php if(isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>" /><br /><br />
						<input class="form-control" type="email" name="mail" placeholder="Votre email" value="<?php if(isset($_POST['mail'])) { echo $_POST['mail']; } ?>" /><br /><br />
						<textarea class="form-control2" name="message" placeholder="Votre message"><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea><br /><br />
						<input type = "submit" class="boutton" name="mailform" value = "Envoyer" />
					</form>


						<?php
						if(isset($msg))
						{
							echo $msg;
						}
						?>
					</div>
					</div>






	<?php include("footer.php"); ?>
	</body>
</html>
