<!DOCTYPE html>
<html>
 <head>
  <title>Formulaire de contact</title>
  <meta charset="utf-8">
 </head>
 <body style="font-family: Helvetica, Arial;">
  <p>Bonjour administrateur,</p>
  <p>Vous avez une réclamation venant de <?php if(isset($_POST['feminin']) AND $_POST['feminin']=="Madame"){ echo"Madame";} else{ echo"Monsieur";}?> <?php echo $prenom ?> <?php echo $nom ?> </p>
  <p>Voici son message :</p>
  <p><?php echo $message ?><br>
  <p>Si vous souhaitez lui répondre, voici son mail : <?php echo $Envoyeur ?></p><br>
  <p>S'il s'agait d'une erreur ou bien d'un message SPAM, veuillez ne pas lui pretter attention et surtout ne pas cliquer sur les liens présents </p>
</body>
</html>
