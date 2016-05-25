<table class="forum">
   <tr class="header">
      <th class="main">Sujet</th>
      <th class="sub-info">Auteur</th>
      <th class="sub-info hide-640">Réponses</th>
      <th class="sub-info messages hide-640">Vues</th>
      <th class="sub-info">Dernière rép.</th>
   </tr>
   <?php while($t = $topics->fetch()) { ?>
   <tr>
      <td class="main">
         <h4><a href=""><a href="topic.php?titre=<?= url_custom_encode($t['sujet']) ?>&id=<?= $t['topic_base_id'] ?>"><?= $t['sujet'] ?></a></a></h4>
      </td>
      <td class="sub-info"><p><?= $t['pseudonyme'] ?></p><!-- <p>le <?= $t['date_heure_creation'] ?></p> --></td>
      <td class="sub-info hide-640"><p><?= reponse_nbr_topic($t['topic_base_id']) ?></p></td>
      <td class="sub-info hide-640"><p>1562</p></td>
      <td class="sub-info"><p><?= derniere_reponse_topic($t['topic_base_id']) ?></p></td>
   </tr>
   <?php } ?>
</table>
<a href="nouveau_topic.php?categorie=<?= $id_categorie ?>" class="boutton">Créer un nouveau topic</a>
