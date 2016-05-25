<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

?>

<!DOCTYPE html>
  <html>
    <head>
       <meta charset ='utf-8'/>
       <link type = "text/css" rel = "stylesheet" href = "stylesheet.css"/>
    </head>
    <body>
    <?php include("header.php");?>

   </br>
   </br>

    <form method="post" action="recherche_perso.php">
      <div class="cadre_rechercheavancee" style="width:75%;margin-left:12%">
        <div class="list-group-item_avancee encadrement_avancee">
          <span style="color:white;">Voulez voulez trouver le groupe de vos rêves? C'est parti!</span>
        </div>

        <br>

        <div class= "formuaire_rechercheavancee">

          <div>
            <label class="label_rechercheavancee">département:</label>
              <select class="selectschrool" name="departement">
           		 <option value="departement" selected="departement">département</option>
                <?php
                  $reponse = connectBDD()->query('SELECT departement FROM groupe_sport');
                    while ($donnees = $reponse->fetch()) {
                        echo "<option>" . $donnees['departement'] . "</option>";
                    }
                ?>
       			  </select>
          </div>

          <br>

          <div>
            <label class="label_rechercheavancee"> Sport visé:</label>
              <select class="selectschrool" name="sport">
                <option value="sport" selected="sport">sport</option>
                  <?php
                    $reponse = connectBDD()->query('SELECT nom_sport FROM sport');
                        while ($donnees = $reponse->fetch()){

                        echo "<option>" . $donnees['nom_sport'] . "</option>";
                        }
                  ?>
              </select>
          </div>

          </br>


          <div>
            <label class="label_rechercheavancee">tranche d'âge:</label>
              <select class="selectschrool" name="age">
                <option value="age" selected="age">âge</option>
                  <?php/*
                    $reponse = connectBDD()->query('SELECT * FROM tranche_age');
                      while ($donnees = $reponse->fetch()){

                      echo "<option>" . $donnees['ages'] . "</option>";
                    }*/

                  ?>
              </select>
          </div>

          </br>

          <div>
            <label class="label_rechercheavancee">nombre de participants maximum:</label>
              <select class="selectschrool" name="participants">
                <option value="limite" selected="limite">le nombre maximum</option>
                  <?php
                    $reponse = connectBDD()->query('SELECT nombre_participant_max FROM groupe_sport');
                      while ($donnees = $reponse->fetch()){
                        echo "<option>" . $donnees['nombre_participant_max'] . "</option>";
                      }
                  ?>
              </select>
          </div>

          </br>

          <div>
            le groupe fait-il parti d'un club?
              <input  style="margin-left:45px;" class="w3-radio" type="radio" name="club" value="1" checked>oui
              <input class="w3-radio" type="radio" name="club" value="0">non
          </div>

          <br>

            <hr style="border-top: 1px dotted #8c8b8b;margin-right:15px;"> </hr>

          <br>

          <div>
            <label class="label_rechercheavancee">chercher un groupe par son nom :</label>
              <input type="text" name="nomgroupe" class="form-control" placeholder=" nom du groupe" >
          </div>

          </br>
          </br>
        </div>

          <button name="forminscription2" class="boutton" type="submit">Rechercher</button>

          <br>

      </div>
    </form>

        <br>

    <?php include("footer.php");?>


    </body>

  </html>
