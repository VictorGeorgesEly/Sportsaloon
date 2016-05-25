<?php
require_once('fonctionSQL.php');

function SendMail(){
  $destinataire=$_POST['adresse_mail'];
  $subject = 'Oublie de mot de passe.';
  $token=GenerateToken();
  AddToken($token);
  ob_start();
  include('mail.php');
  $message=ob_get_contents();
  ob_end_clean();
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  return mail($destinataire, $subject, $message, $headers);
}

function SendMail1(){
  $sexef=$_POST['feminin'];
  $Envoyeur=$_POST['mail'];
  $nom=$_POST['nom'];
  $prenom=$_POST['prenom'];
  $message=$_POST['message'];
  $subject = 'Contact';
  ob_start(); //mettre en tampon les informations
  include('mail1.php');
  $message1=ob_get_contents();
  ob_end_clean();
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  return mail("vely@juniorisep.com", $subject, $message1, $headers);
}

/*function SendMail2($key,$broot){
  $prenom=$_POST['prenom'];
  $nom=$_POST['nom'];
  $mail=$_POST['adresse_mail'];
  $subject = 'Confirmation inscription';
  ob_start();
  include('mail2.php');
  $message2=ob_get_contents();
  ob_end_clean();
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

  return mail($mail, $subject, $message2, $headers);
}*/

function GenerateToken($length=30){
  $token = "abcdefghiklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0987654321";
  $token = substr(str_shuffle(str_repeat($token,10)), 0, $length);
  return $token;
}

function url_custom_encode($titre) {
  $titre = htmlspecialchars($titre);
  $find = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Œ', 'œ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Š', 'š', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', 'Ÿ', '?', '?', '?', '?', 'Ž', 'ž', '?', 'ƒ', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $replace = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?');
    $titre = str_replace($find, $replace, $titre);
  $titre = strtolower($titre);
  $mots = preg_split('/[^A-Z^a-z^0-9]+/', $titre);
  $encoded = "";
  foreach($mots as $mot) {
     if(strlen($mot) >= 3 OR str_replace(['0','1','2','3','4','5','6','7','8','9'], '', $mot) != $mot) {
        $encoded .= $mot.'-';
     }
  }
  $encoded = substr($encoded, 0, -1);
  return $encoded;
}




/*function Calendrier($month,$year,$links) {

  $MonthNames = array(1 => "Janvier","Fevrier","Mars","Avril","Mai","Juin",
               "Juillet","Aout","Septembre","Octobre","Novembre","Decembre");
  $monthname = $MonthNames[$month+0];

  // on ouvre la table
  echo '<table class="cal" cellspacing="1">';

  // Première ligne = mois et année ou link[0]
  $title = array_key_exists(0, $links) ? $links[0] : $monthname.' '.$year;
  echo '<tr><td colspan="7" class="cal_titre">'.$title.'</td>'."</tr>\n";

  // Seconde lignes = initiales des jours de la semaine
  $DayNames = array("L","M","M","J","V","S","D");
  echo '<tr>'; foreach ($DayNames as $d) echo '<th>'.$d.'</th>'; echo "</tr>\n";

  // On regarde si aujourd'hui est dans ce mois pour mettre un style particulier
  if ($year == date('Y') && $month == date('m'))
    $today = date('d');
  else
    $today = 0;

  $time = mktime(0,0,0,$month,1,$year); // timestamp du 1er du mois demandé
  $days_in_month = date('t',$time);     // nombre de jours dans le mois
  $firstday = date('w',$time);          // jour de la semaine du 1er du mois
  if ($firstday == 0) $firstday = 7;    // attention, en php, dimanche = 0

  $daycode = 1; // ($daycode % 7) va nous indiquer le jour de la semaine.
                // on commence par le lundi, c'est-à-dire 1.

  // on ouvre une première ligne pour le calendrier proprement dit :
  echo '<tr>';

  // on met des cases blanches jusqu'à la veille du 1er du mois :
  for ( ; $daycode<$firstday; $daycode++) echo '<td>&nbsp;</td>';

  // boucle sur tous les jours du mois :
  for ($numday = 1; $numday <= $days_in_month; $numday++, $daycode++) {
    // si on en est au lundi (sauf le 1er),
    // on ferme la ligne précédente et on en ouvre une nouvelle
    if ($daycode%7 == 1 && $numday != 1) echo "</tr>\n".'<tr>';
    // on ouvre la case (avec un style particulier s'il s'agit d'aujourd'hui)
    echo ($numday == $today ? '<td class="today">' : '<td>');
    // on affiche le numéro du jour ou le contenu donné par l'utilisateur
    echo (array_key_exists($numday, $links) ? $links[$numday] : $numday);
    // on ferme la case
    echo '</td>';
    }

  // on met des cases blanches pour completer la dernière semaine si besoin :
  for ( ; $daycode%7 != 1; $daycode++) echo '<td>&nbsp;</td>';

  // on ferme la dernière ligne, et la table.
  echo '</tr>'; echo "</table>\n\n";
}*/



?>
