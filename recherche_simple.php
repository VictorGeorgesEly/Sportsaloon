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

  <?php include("header.php");

    if (isset($_POST['sport'])) {  //isset --> test si la recherche est faite si le formulaire est rempli
        echo '<table><caption>Résultats de la recherche</caption>
                <tr>
                    <th>Nom du groupe</th>
                    <th>Sport pratiqué</th>
                    <th>Département</th>
                </tr>';
        $reponse = connectBDD()->prepare('SELECT * FROM groupe_sport WHERE sport = :tmp1 AND departement = :tmp2 '); //requète préparée-->  sport et departement du groupe identiques à ceux des tables departement et sport
        $reponse->execute(array(   //requète préparée
            'tmp1' => $_POST['sport'],
            'tmp2' => $_POST['departement']

        ));
        while ($donnees = $reponse->fetch()) {   //ligne par ligne
            $verif=True;  //
            echo '<tr>'
                  . '<td><a href="">' . $donnees['nom_groupe'] . '</a></td>'  // <a href: lien pour accéder à la page de groupe>
                  . '<td>' . $donnees['sport'] . '</td>'
                  . '<td>' . $donnees['departement'] . '</td>'
                . '</tr>';
        }
        echo '</table>';
        if (!isset($verif)) {echo "Pas de résultat !";}  //  si il n'y a pas de résultats
    }
 include("footer.php"); ?>
</body>
</html>
