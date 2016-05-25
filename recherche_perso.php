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
    if(isset ($_POST['nomgroupe']) ){
        $reponse = $bdd->prepare('SELECT * FROM groupesport WHERE nomg LIKE :tmp6');

        $reponse->execute(array( 'tmp6' => '%'.$_POST['nomgroupe'].'%'

          ));

     echo '<table><caption>Résultats de la recherche</caption>
            <tr>
                <th>Nom du groupe</th>
                <th>Sport pratiqué</th>
                <th>Département</th>
            </tr>';
    }if(empty($_POST['nomgroupe'])){
      //isset: test si la recherche est faite

        $reponse = $bdd->prepare('SELECT * FROM groupesport WHERE sport = :tmp1 AND departement_code = :tmp2  AND age_groupe= :tmp3 AND club_ou_pas= :tmp4 AND nombre_participants_groupe= :tmp5'); //recherche dans les bdd vérifie que le sport que tu as sélectionné est égal à celui qui est recherché

        $reponse->execute(array(   //requète préparée
            'tmp1' => $_POST['sport'],
            'tmp2' => $_POST['departement'],
            'tmp3' => $_POST['age'],
            'tmp4' => $_POST['club'],
            'tmp5' => $_POST['participants']


        ));

        }
        $i = 0;
        while ($donnees = $reponse->fetch()) {   //ligne par ligne

            $verif=True;


            echo '<tr>'
                . '<td><a href="">' . $donnees['nomg'] . '</a></td>'  // <a href: lien pour accéder à la page de groupe>
                . '<td>' . $donnees['sport'] . '</td>'
                . '<td>' . $donnees['departement_code'] . '</td>'

            . '</tr>';
            $i++;
        }
        echo '</table>';

        if (!isset($verif)) {echo "Pas de résultat !";}  //  si il n'y a pas de résultats
        else
          if($i==1)
            {echo "$i résultat";}
          else
            {echo "$i résultats";}

        include("footer.php"); ?>
       </body>
       </html>
