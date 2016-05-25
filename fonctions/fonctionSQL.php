<?php require_once('connectBDD.php');

function Inscription($pseudonyme){
  $pseudonyme = htmlspecialchars($_POST['pseudonyme']);
  $password = sha1($_POST['mot_de_passe']);
  $sql="INSERT INTO utilisateur (pseudonyme, mot_de_passe) VALUES (?,?)";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme,$password]);
}

function pseudonymefree($pseudonyme){
  $sql="SELECT pseudonyme FROM utilisateur WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme]);
  $resultat=$query->fetch();
  return $resultat;
}

function Inscription2($pseudonyme,$key){
  //$sexeh=htmlspecialchars($_POST['serie1']);
  //$sexef=htmlspecialchars($_POST['serie2']);
  $prenom=htmlspecialchars($_POST['prenom']);
  $nom=htmlspecialchars($_POST['nom']);
  $mail=htmlspecialchars($_POST['adresse_mail']);
  $mail2=htmlspecialchars($_POST['mail2']);
  $codepostal=htmlspecialchars($_POST['codepostal']);
  $ville=htmlspecialchars($_POST['ville']);
  $adresse=htmlspecialchars($_POST['adresse']);
  $region=htmlspecialchars($_POST['region']);
  $jour=htmlspecialchars($_POST['jour']);
  $mois=htmlspecialchars($_POST['mois']);
  $annee=htmlspecialchars($_POST['annee']);
  $age=htmlspecialchars($_POST['age']);
  $pays=htmlspecialchars($_POST['pays']);
  //$sport=htmlspecialchars($_POST['sport']);
  //$descriptif=htmlspecialchars($_POST['descriptif']);
  $sql="UPDATE utilisateur SET prenom=?,nom=?,adresse_mail=?,codepostal=?,ville=?,region=?,adresse=?,jour=?,mois=?,annee=?,age=?,pays=?,confirmkey=? WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$prenom,$nom,$mail,$codepostal,$ville,$region,$adresse,$jour,$mois,$annee,$age,$pays,$key,$pseudonyme]);
}

function Connexion($pseudonyme){
  $sql="SELECT * FROM utilisateur WHERE pseudonyme=? and mot_de_passe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme, sha1($_POST['mot_de_passe'])]);
  $resultat=$query->fetch();
  return $resultat;
}

function updateConnexion($pseudonyme, $mot_de_passe){
  $sql="SELECT * FROM utilisateur WHERE pseudonyme=? and mot_de_passe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme, $mot_de_passe]);
  $resultat=$query->fetch();
  return $resultat;
}

function PseudonymeEmailMatch(){
  $sql="SELECT pseudonyme, adresse_mail FROM utilisateur WHERE pseudonyme=? and adresse_mail=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$_POST['pseudonyme'], $_POST['adresse_mail']]);
  $resultat=$query->fetch();
  return $resultat;
}

function AddToken($token){
  $sql="UPDATE utilisateur SET token=? WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$token, $_POST['pseudonyme']]);
}

function TokenExists(){
  $sql="SELECT pseudonyme FROM utilisateur WHERE token=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$_GET['token']]);
  $resultat=$query->fetch();
  return $resultat;
}

function UpdateMDP($pseudonyme){
  $sql="UPDATE utilisateur SET mot_de_passe=? WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([sha1($_POST['mot_de_passe']), $pseudonyme]);
  $sql="UPDATE utilisateur SET token=null WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme]);
}

function UpdateMDP1($pseudonyme){
  $sql="UPDATE utilisateur SET mot_de_passe=? WHERE pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([sha1($_POST['mot_de_passe']), $pseudonyme]);
}

function Updatemail($pseudonyme){
  $sql="UPDATE utilisateur SET adresse_mail = ? WHERE pseudonyme = ?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['adresse_mail']), $pseudonyme]);
}

function Updatepseudo($pseudonyme){
  $sql="UPDATE utilisateur SET pseudonyme = ? WHERE pseudonyme = ?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['newpseudo']), $pseudonyme]);
}

function updateadressemail($pseudonyme){
  $sql="SELECT * FROM utilisateur WHERE adresse_mail=? and pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['adresse_mail']), $pseudonyme]);
  $resultat=$query->fetch();
  return $resultat;
}

function update_mdp($pseudonyme){
  $sql="SELECT * FROM utilisateur WHERE mot_de_passe=? and pseudonyme=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([sha1($_POST['mot_de_passe']), $pseudonyme]);
  $resultat=$query->fetch();
  return $resultat;
}

function Updatepseudonyme($idutilisateur){
  $sql="SELECT * FROM utilisateur WHERE pseudonyme=? and idutilisateur=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['newpseudo']), $idutilisateur]);
  $resultat=$query->fetch();
  return $resultat;
}

function Updateavatar($idutilisateur){
  $sql="SELECT * FROM utilisateur WHERE avatar=? and idutilisateur=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$_FILES['avatar'], $idutilisateur]);
  $resultat=$query->fetch();
  return $resultat;
}

function get_pseudo($id){
   $pseudo = connectBDD()->prepare('SELECT pseudonyme FROM utilisateur WHERE pseudonyme = ?');
   $pseudo->execute(array($id));
   $pseudo = $pseudo->fetch()['pseudonyme'];
   return $pseudo;
}

function reponse_nbr_categorie($id_categorie) {
   $nbr = connectBDD()->prepare('SELECT f_messages.id FROM f_messages LEFT JOIN f_topics_categories ON f_topics_categories.id_topic = f_messages.id_topic WHERE f_topics_categories.id_categorie = ?');
   $nbr->execute(array($id_categorie));
   return $nbr->rowCount();
}
function reponse_nbr_topic($id_topic) {
   $nbr = connectBDD()->prepare('SELECT f_messages.id FROM f_messages LEFT JOIN f_topics ON f_topics.id = f_messages.id_topic WHERE f_topics.id = ?');
   $nbr->execute(array($id_topic));
   return $nbr->rowCount();
}
function derniere_reponse_categorie($id_categorie) {
   $rep = connectBDD()->prepare('SELECT f_messages.* FROM f_messages LEFT JOIN f_topics_categories ON f_topics_categories.id_topic = f_messages.id_topic WHERE f_topics_categories.id_categorie = ? ORDER BY f_messages.date_heure_post DESC LIMIT 0,1');
   $rep->execute(array($id_categorie));
   if($rep->rowCount() > 0) {
      $rep = $rep->fetch();
      $dr = $rep['date_heure_post'];
      $dr .= '<br /> de '.get_pseudo($rep['id_posteur']);
   } else {
      $dr = 'Aucune réponse...';
   }
   return $dr;
}
function derniere_reponse_topic($id_topic) {
   $rep = connectBDD()->prepare('SELECT f_messages.* FROM f_messages LEFT JOIN f_topics ON f_topics.id = f_messages.id_topic WHERE f_topics.id = ? ORDER BY f_messages.date_heure_post DESC LIMIT 0,1');
   $rep->execute(array($id_topic));
   if($rep->rowCount() > 0) {
      $rep = $rep->fetch();
      $dr = $rep['date_heure_post'];
      $dr .= '<br /> de '.get_pseudo($rep['id_posteur']);
   } else {
      $dr = 'Aucune réponse...';
   }
   return $dr;
}

function isAdmin($pseudonyme){
  //premiere_co = 1 -> FIRST TIME.
  $sql="SELECT admin_util FROM utilisateur WHERE pseudonyme=? and admin_util=1";
  $query=connectBDD()->prepare($sql);
  $query->execute([$pseudonyme]);
  $resultat=$query->fetch();
  return $resultat;
}


function evenement(){
  $nom=htmlspecialchars($_POST['nom_evenement']);
  $type=htmlspecialchars($_POST['sport']);
  $description=htmlspecialchars($_POST['descri']);
  $postal=htmlspecialchars($_POST['postal']);
  $adresse=htmlspecialchars($_POST['adresse']);
  $ville=htmlspecialchars($_POST['ville']);
  $pays=htmlspecialchars($_POST['pays']);
  $date_debut=htmlspecialchars($_POST['date_debut']);
  $heure_d=htmlspecialchars($_POST['heure_d']);
  $min_d=htmlspecialchars($_POST['min_d']);
  $date_f=htmlspecialchars($_POST['date_f']);
  $heure_f=htmlspecialchars($_POST['heure_f']);
  $min_f=htmlspecialchars($_POST['min_f']);
  $nb_place=htmlspecialchars($_POST['nb_place']);
  $sql="INSERT INTO evenement (nom_evenement,sport,descri,postal,adresse,ville,pays,date_debut,heure_d,min_d,date_f,heure_f,min_f,nb_place) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
  $query=connectBDD()->prepare($sql);
  $query->execute([$nom,$type,$description,$postal,$adresse,$ville,$pays,$date_debut,$heure_d,$min_d,$date_f,$heure_f,$min_f,$nb_place]);
}

function creationgroupe(){
  $nom=htmlspecialchars($_POST['nom_groupe']);
  $sport=htmlspecialchars($_POST['sport']);
  $description=htmlspecialchars($_POST['description']);
  $nombre=htmlspecialchars($_POST['nombre_participant_max']);
  $club=htmlspecialchars($_POST['club']);
  $sql="INSERT INTO groupe_sport (nom_groupe,sport,description,nombre_participant_max,club) VALUES (?,?,?,?,?)";
  $query=connectBDD()->prepare($sql);
  $query->execute([$nom,$sport,$description,$nombre,$club]);
}

function modifiergroupe(){
  $nom1=htmlspecialchars($_GET['nom_groupe']);
  $sql1="SELECT id_groupe FROM groupe_sport WHERE nom_groupe=?";
  $query1=connectBDD()->prepare($sql1);
  $query1->execute([$nom1]);
  $id_groupe=$query1->fetch();
  $id_groupe=$id_groupe[0];
  $nom=htmlspecialchars($_POST['nom_groupe']);
  $sport=htmlspecialchars($_POST['sport']);
  $description=htmlspecialchars($_POST['description']);
  $nombre=htmlspecialchars($_POST['nombre_participant_max']);
  $club=htmlspecialchars($_POST['club']);
  $sql="UPDATE groupe_sport SET nom_groupe=?,sport=?,description=?,nombre_participant_max=?,club=?) WHERE id_groupe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([$nom,$sport,$description,$nombre,$club,$id_groupe]);
}

function Updatepnomgroupe($id_groupe){
  $sql="UPDATE groupe_sport SET nom_groupe=? WHERE id_groupe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['new_nom_groupe']), $id_groupe]);
}

function Updatepsport($id_groupe){
  $sql="UPDATE groupe_sport SET sport=? WHERE id_groupe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['new_sport']), $id_groupe]);

}

function Updatepclub($id_groupe){
  $sql="UPDATE groupe_sport SET club=? WHERE id_groupe=?";
  $query=connectBDD()->prepare($sql);
  $query->execute([htmlspecialchars($_POST['new_club']), $id_groupe]);
}

?>
