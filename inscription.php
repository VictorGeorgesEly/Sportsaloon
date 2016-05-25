<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

if(!isset($_SESSION['sportsaloon'])){
  require_once('404.php');
  die;
}

?>


<html>
  <head>
    <meta charset='utf-8'/>
    <link rel="stylesheet" href="stylesheet.css" />
    <title>Inscription</title>
    <link rel="shortcut icon" href="IMG/favicon.ico">
  </head>

  <body>

  <?php include("header.php"); ?>
<br><br>

    <?php if(isset($_POST['forminscription2'])){
      $mail=htmlspecialchars($_POST['adresse_mail']);
      $mail2=htmlspecialchars($_POST['mail2']);

      if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['adresse_mail']) AND !empty($_POST['mail2']) AND !empty($_POST['codepostal']) AND !empty($_POST['ville']) AND !empty($_POST['region']) AND !empty($_POST['adresse']) AND !empty($_POST['jour']) AND !empty($_POST['mois']) AND !empty($_POST['annee']) AND !empty($_POST['age']) AND !empty($_POST['pays'])){
        if ($mail == $mail2){
          if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['adresse_mail'])){
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail2'])){

              $longueurkey = 15;
              $key = "";
              for($i=1;$i<$longueurkey;$i++){
                $key .= mt_rand(0,9);
              }

              $header="MIME-Version: 1.0\r\n";
              $header.='From:"Sportsaloon.com"<sportsaloon@gmail.com>'."\n";
              $header.='Content-Type:text/html; charset="uft-8"'."\n";
              $header.='Content-Transfer-Encoding: 8bit';

              $message='
              <html>
              	<body>
              		<div align="center">
              			<a href="http://localhost:8888/APP/confirmation.php?pseudonyme='.urlencode($_SESSION['sportsaloon']).'&key='.$key.'">Confirmation du compte</a>
              		</div>
              	</body>
              </html>
              ';

              mail($mail, "Confirmation du compte", $message, $header);


              if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
                $taillemax=2097152;
                $extensionsvalides=array('jpg','jpeg','gif','png');
                if($_FILES['avatar']['size'] <= $taillemax){
                  $extensionupload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'),1)); // check si tout minuscule et l'extension
                  if(in_array($extensionupload, $extensionsvalides)){
                    $chemin = "IMG/avatar/".$_SESSION['id'].".".$extensionupload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin); //stockage temporaire
                    if($resultat){
                      $updateavatar = connectBDD()->prepare('UPDATE utilisateur SET avatar = :avatar WHERE pseudonyme = :pseudonyme');
                      $updateavatar -> execute(array(
                        'avatar' => $_SESSION['id'].".".$extensionupload,
                        'pseudonyme' => $_SESSION['id']
                      ));
                      Inscription2($_SESSION['sportsaloon'],$key);
                      header('Location: deconnexion.php');
                    }
                    else{
                      $msg = "Erreur lors de l'importation de la photo de profil...";
                    }
                  }
                  else{
                    $msg = "Votre photo de profil doit être au format indiqué !";
                  }
                }
                else{
                  $msg = "Votre photo de profil ne doit pas dépasser 2 Mo !";
                }
              }
            }
            else{
              echo "L'adresse mail n'est pas valide !";
            }
          }
          else{
            echo "L'adresse mail n'est pas valide !";
          }
        }
        else{
          echo "Les deux email ne sont pas identiques !";
        }
      }
      else{
        echo "Les champs ne sont pas tous remplis !";
      }
    }
    ?>


  <form action="" method="post" enctype="multipart/form-data">
    <div class="inscriptionetconnexion" style="width:80%;margin-left:10%">
      <p class="titreboite">Formulaire d'inscription  de <?php echo $_SESSION['sportsaloon']?></p>
        <div>
          <div class="list-group-item encadrement">
          <span style="color:white;">Formulaire d'inscription</span>
          </div>
            <div class="list-group-item">
              <div>
                <span>Sexe :*</span>
                <input class="w3-radio" type="radio" name="feminin" value="Monsieur" checked>
                <label class="w3-validate">Homme</label>
                <input class="w3-radio" type="radio" name="feminin" value="Madame">
                <label class="w3-validate">Femme</label>
              </div>
              <br>
              <div>
                <table style="background-color:white">
                  <tr>
                    <td>
                      <label for="prenom">Prénom :</label>
                    </td>
                    <td>
                      <input type="text" value="<?php if(isset($prenom)) {echo $prenom; } ?>" class="form-control" style="width: 50%;" name="prenom"  placeholder="Votre prénom" id="prenom">
                    </td>
                    <td>
                      <label for="nom">Nom :</label>
                    </td>
                    <td>
                      <input class="form-control" value="<?php if(isset($nom)) {echo $nom; } ?>" style="width: 50%;" type="text" name="nom"  placeholder="Votre nom" id="nom">
                    </td>
                  </tr>
                  <tr>
                      <td>
                        <label for="mail">Adresse mail :</label>
                      </td>
                      <td>
                        <input class="form-control" style="width: 50%;" type="text" value="<?php if(isset($mail)) {echo $mail; } ?>" name="adresse_mail" placeholder="Adresse email" id="mail">
                      </td>
                      <td>
                        <label for="mail2">Confirmation du mail :</label>
                      </td>
                      <td>
                        <input class="form-control" style="width: 50%;" type="text"  name="mail2" placeholder="Confirmation adresse email" id="mail2">
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <label for"codepostal">Code postal :</label>
                    </td>
                    <td>
                      <input class="form-control" value="<?php if(isset($codepostal)) {echo $codepostal; } ?>" style="width: 50%;" type="text" name="codepostal"  placeholder="75001" id="codepostal">
                    </td>
                    <td>
                      <label for"ville">Ville :</label>
                    </td>
                    <td>
                      <input class="form-control" value="<?php if(isset($ville)) {echo $ville; } ?>" style="width: 50%;" type="text" name="ville" placeholder="Ville" id="ville" >
                    </td>
                  </tr>
                  <tr>
                      <td>
                        <label for="adresse"> Adresse :</label>
                      </td>
                      <td>
                        <input class="form-control" value="<?php if(isset($adresse)) {echo $adresse; } ?>" style="width: 50%;" id="ville" type="text" name="adresse" placeholder="Votre adresse de domicile">
                      </td>
                      <td>
                        <span >Région :</span>
                      </td>
                      <td>
                        <input class="form-control" style="width: 50%;" type="text" value="" name="region" placeholder="Région" >
                      </td>
                  </tr>
                </table>

              </div>
              <br>
              <div>
                <span>Votre âge :</span>
                <select class="selectschrool"  name=age size=1>
                  <option value=age selected>Âge</option>
                  <?php
                  $nombre=13;
                  while ($nombre <= 113){ ?>
                  <option value="<?php echo $nombre ?>"><?php echo $nombre ?></option>
                  <?php $nombre=$nombre; $nombre++;} ?>
                </select>
              </div>
              <br>
              <div>
                <span>Date de naissance :</span>
                <select class="selectschrool" name=jour size=1>
                  <option value=jour selected>Jour</option>
                  <?php
                  $nombre1=1;
                  while ($nombre1 <= 31){ ?>
                  <option value="<?php echo $nombre1 ?>"><?php echo $nombre1 ?></option>
                  <?php $nombre1=$nombre1; $nombre1++;} ?>
                </select>
                <select class="selectschrool" name=mois size=1>
                    <option value=mois selected>Mois<option value="1">Janvier<option value="2">Février<option value="3">Mars<option value="4">Avril<option value="5">Mai<option value="6">Juin<option value="7">Juillet<option value="8">Aout<option value="9">Septembre<option value="10">Octobre<option value="11">Novembre<option value="12">Décembre
                </select>
                <select class="selectschrool" name=annee size=1>
                  <option value=annee selected>Année</option>
                  <?php
                  $nombre2=1900;
                  while ($nombre2 <= date('Y')){ ?>
                  <option value="<?php echo $nombre2 ?>"><?php echo $nombre2 ?></option>
                  <?php $nombre2=$nombre2; $nombre2++;} ?>
                </select>
              </div>
                <br>


              <div>

                <span>Pays :</span>
                <select class="selectschrool" name="pays">
                  <option value="Afghanistan">Afghanistan </option><option value="Afrique_Centrale">Afrique_Centrale </option><option value="Afrique_du_sud">Afrique_du_Sud </option> <option value="Albanie">Albanie </option><option value="Algerie">Algerie </option><option value="Allemagne">Allemagne </option><option value="Andorre">Andorre </option><option value="Angola">Angola </option><option value="Anguilla">Anguilla </option><option value="Arabie_Saoudite">Arabie_Saoudite </option><option value="Argentine">Argentine </option><option value="Armenie">Armenie </option> <option value="Australie">Australie </option><option value="Autriche">Autriche </option><option value="Azerbaidjan">Azerbaidjan </option><option value="Bahamas">Bahamas </option><option value="Bangladesh">Bangladesh </option><option value="Barbade">Barbade </option><option value="Bahrein">Bahrein </option><option value="Belgique">Belgique </option><option value="Belize">Belize </option><option value="Benin">Benin </option><option value="Bermudes">Bermudes </option><option value="Bielorussie">Bielorussie </option><option value="Bolivie">Bolivie </option><option value="Botswana">Botswana </option><option value="Bhoutan">Bhoutan </option><option value="Boznie_Herzegovine">Boznie_Herzegovine </option><option value="Bresil">Bresil </option><option value="Brunei">Brunei </option><option value="Bulgarie">Bulgarie </option><option value="Burkina_Faso">Burkina_Faso </option><option value="Burundi">Burundi </option><option value="Caiman">Caiman </option><option value="Cambodge">Cambodge </option><option value="Cameroun">Cameroun </option><option value="Canada">Canada </option><option value="Canaries">Canaries </option><option value="Cap_vert">Cap_Vert </option><option value="Chili">Chili </option><option value="Chine">Chine </option> <option value="Chypre">Chypre </option> <option value="Colombie">Colombie </option><option value="Comores">Colombie </option><option value="Congo">Congo </option><option value="Congo_democratique">Congo_democratique </option><option value="Cook">Cook </option><option value="Coree_du_Nord">Coree_du_Nord </option><option value="Coree_du_Sud">Coree_du_Sud </option><option value="Costa_Rica">Costa_Rica </option><option value="Cote_d_Ivoire">Côte_d_Ivoire </option><option value="Croatie">Croatie </option><option value="Cuba">Cuba </option><option value="Danemark">Danemark </option><option value="Djibouti">Djibouti </option><option value="Dominique">Dominique </option><option value="Egypte">Egypte </option> <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option><option value="Equateur">Equateur </option><option value="Erythree">Erythree </option><option value="Espagne">Espagne </option><option value="Estonie">Estonie </option><option value="Etats_Unis">Etats_Unis </option><option value="Ethiopie">Ethiopie </option><option value="Falkland">Falkland </option><option value="Feroe">Feroe </option><option value="Fidji">Fidji </option><option value="Finlande">Finlande </option><option value="France" selected>France </option><<option value="Gambie">Gambie </option><option value="Georgie">Georgie </option><option value="Ghana">Ghana </option><option value="Gibraltar">Gibraltar </option><option value="Grece">Grece </option><option value="Grenade">Grenade </option><option value="Groenland">Groenland </option><option value="Guadeloupe">Guadeloupe </option><option value="Guam">Guam </option><option value="Guatemala">Guatemala</option><option value="Guernesey">Guernesey </option><option value="Guinee">Guinee </option><option value="Guinee_Bissau">Guinee_Bissau </option><option value="Guinee equatoriale">Guinee_Equatoriale </option><option value="Guyana">Guyana </option><option value="Guyane_Francaise ">Guyane_Francaise </option><option value="Haiti">Haiti </option><option value="Hawaii">Hawaii </option> <option value="Honduras">Honduras </option><option value="Hong_Kong">Hong_Kong </option><option value="Hongrie">Hongrie </option><option value="Inde">Inde </option><option value="Indonesie">Indonesie </option><option value="Iran">Iran </option><option value="Iraq">Iraq </option><option value="Irlande">Irlande </option><option value="Islande">Islande </option><option value="Israel">Israel </option><option value="Italie">italie </option><option value="Jamaique">Jamaique </option><option value="Jan Mayen">Jan Mayen </option><option value="Japon">Japon </option><option value="Jersey">Jersey </option><option value="Jordanie">Jordanie </option><option value="Kazakhstan">Kazakhstan </option><option value="Kenya">Kenya </option><option value="Kirghizstan">Kirghizistan </option><option value="Kiribati">Kiribati </option><option value="Koweit">Koweit </option><option value="Laos">Laos </option><option value="Lesotho">Lesotho </option><option value="Lettonie">Lettonie </option><option value="Liban">Liban </option><option value="Liberia">Liberia </option><option value="Liechtenstein">Liechtenstein </option><option value="Lituanie">Lituanie </option> <option value="Luxembourg">Luxembourg </option><option value="Lybie">Lybie </option><option value="Macao">Macao </option><option value="Macedoine">Macedoine </option><option value="Madagascar">Madagascar </option><option value="Madère">Madère </option>option value="Malaisie">Malaisie </option><option value="Malawi">Malawi </option><option value="Maldives">Maldives </option><option value="Mali">Mali </option><option value="Malte">Malte </option><option value="Man">Man </option><option value="Mariannes du Nord">Mariannes du Nord </option><option value="Maroc">Maroc </option><option value="Marshall">Marshall </option><option value="Martinique">Martinique </option><option value="Maurice">Maurice </option><option value="Mauritanie">Mauritanie </option><option value="Mayotte">Mayotte </option><option value="Mexique">Mexique </option><option value="Micronesie">Micronesie </option><option value="Midway">Midway </option><option value="Moldavie">Moldavie </option><option value="Monaco">Monaco </option><option value="Mongolie">Mongolie </option><option value="Montserrat">Montserrat </option><option value="Mozambique">Mozambique </option><option value="Namibie">Namibie </option><option value="Nauru">Nauru </option><option value="Nepal">Nepal </option><option value="Nicaragua">Nicaragua </option><option value="Niger">Niger </option><option value="Nigeria">Nigeria </option><option value="Niue">Niue </option><option value="Norfolk">Norfolk </option><option value="Norvege">Norvege </option><option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option><option value="Nouvelle_Zelande">Nouvelle_Zelande </option><option value="Oman">Oman </option><option value="Ouganda">Ouganda </option><option value="Ouzbekistan">Ouzbekistan </option><option value="Pakistan">Pakistan </option><option value="Palau">Palau </option><option value="Palestine">Palestine </option><option value="Panama">Panama </option><option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option><option value="Paraguay">Paraguay </option><option value="Pays_Bas">Pays_Bas </option><option value="Perou">Perou </option><option value="Philippines">Philippines </option> <option value="Pologne">Pologne </option><option value="Polynesie">Polynesie </option><option value="Porto_Rico">Porto_Rico </option><option value="Portugal">Portugal </option><option value="Qatar">Qatar </option><option value="Republique_Dominicaine">Republique_Dominicaine </option><option value="Republique_Tcheque">Republique_Tcheque </option><option value="Reunion">Reunion </option><option value="Roumanie">Roumanie </option><option value="Royaume_Uni">Royaume_Uni </option><option value="Russie">Russie </option><option value="Rwanda">Rwanda </option><option value="Sahara Occidental">Sahara Occidental </option><option value="Sainte_Lucie">Sainte_Lucie </option><option value="Saint_Marin">Saint_Marin </option><option value="Salomon">Salomon </option><option value="Salvador">Salvador </option><option value="Samoa_Occidentales">Samoa_Occidentales</option><option value="Samoa_Americaine">Samoa_Americaine </option><option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option> <option value="Senegal">Senegal </option> <option value="Seychelles">Seychelles </option><option value="Sierra Leone">Sierra Leone </option><option value="Singapour">Singapour </option><option value="Slovaquie">Slovaquie </option><option value="Slovenie">Slovenie</option><option value="Somalie">Somalie </option><option value="Soudan">Soudan </option> <option value="Sri_Lanka">Sri_Lanka </option> <option value="Suede">Suede </option><option value="Suisse">Suisse </option><option value="Surinam">Surinam </option>option value="Swaziland">Swaziland </option><option value="Syrie">Syrie </option><option value="Tadjikistan">Tadjikistan </option><option value="Taiwan">Taiwan </option><option value="Tonga">Tonga </option><option value="Tanzanie">Tanzanie </option><option value="Tchad">Tchad </option><option value="Thailande">Thailande </option><option value="Tibet">Tibet </option><option value="Timor_Oriental">Timor_Oriental </option><option value="Togo">Togo </option> <option value="Trinite_et_Tobago">Trinite_et_Tobago </option><option value="Tristan da cunha">Tristan de cuncha </option><option value="Tunisie">Tunisie </option><option value="Turkmenistan">Turmenistan </option> <option value="Turquie">Turquie </option><option value="Ukraine">Ukraine </option><option value="Uruguay">Uruguay </option><option value="Vanuatu">Vanuatu </option><option value="Vatican">Vatican </option><option value="Venezuela">Venezuela </option><option value="Vierges_Americaines">Vierges_Americaines </option><option value="Vierges_Britanniques">Vierges_Britanniques </option><option value="Vietnam">Vietnam </option><option value="Wake">Wake </option><option value="Wallis et Futuma">Wallis et Futuma </option><option value="Yemen">Yemen </option><option value="Yougoslavie">Yougoslavie </option><option value="Zambie">Zambie </option><option value="Zimbabwe">Zimbabwe </option>
                  </select>
                </div>
              </div>
            </div></br>


            <div>
              <div >
                <div>
                  <span>Sport pratiqué :</span><br>
                  <form><textarea class="form-control1" style="resize: none;" row="5" cols="54" name="Sport"></textarea></form>
                </div>
                  <div>
                    <span>Descriptif de votre profil :</span>
                    <form><textarea class="form-control1" style="resize: none;" row="5" cols="54" name="descriptif"></textarea></form>
                  </div>
                </div>
              </div>
              <label for="">Avatar (JPG, PNG ou GIF | max. 15 Ko) :</label><br>
              <input type="file" name="avatar"><br>
              </form>

            </br>
            <button name="forminscription2" class="boutton" type="submit">Inscription</button><br>
          </div>
    </form>


<br/>

  <?php include("footer.php"); ?>

  </body>
</html>
