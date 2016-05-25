<!DOCTYPE html>
<html>
 <head>
  <title>Mot de passe oublié</title>
  <meta charset="utf-8">
 </head>
 <body style="font-family: Helvetica, Arial;">
  <p>Bonjour,</p>
  <p>Une demande de réinitialisation de mot de passe a été effectuée depuis votre compte depuis le site <a href="http://localhost:8888/APP/index.php">Sportsaloon.</a></p>
  <p>Cliquez sur ce lien afin de le réinitialiser : <a href="http://localhost:8888/APP/resetpassword.php?token=<?php echo $token ?>">ici</a></p>
  <p>Si vous n'êtes pas à l'origine de cette demande, veuillez ignorer ce mail.</p>
</body>
</html>
