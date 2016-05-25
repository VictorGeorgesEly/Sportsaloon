<table class="forum">
   <tr class="header">
      <th class="main">Catégories</th>
      <th class="sub-info messages hide-640">Réponses</th>
      <th class="sub-info messages hide-640">Vues</th>
      <th class="sub-info dmessage">Dernière réponse</th>
   </tr>
   <?php
   while($c = $categories->fetch()) {
      $subcat->execute(array($c['id']));
      $souscategories = '';
      while($sc = $subcat->fetch()) {
         $souscategories .= '<a href="forum_topic.php?categorie='.url_custom_encode($c['nom']).'&souscategorie='.url_custom_encode($sc['nom']).'">'.$sc['nom'].'</a> | ';
      }
      $souscategories = substr($souscategories, 0, -3);
   ?>
   <tr class="categories">
      <td class="main">
         <h4><a href="forum_topic.php?categorie=<?= url_custom_encode($c['nom']) ?>"><?= $c['nom'] ?></a></h4>
         <p>
         <?= $souscategories ?>
         </p>
      </td>
      <td class="sub-info hide-640"><?= reponse_nbr_categorie($c['id']) ?></td>
      <td class="sub-info hide-640">xxx</td>
      <td class="sub-info"><?= derniere_reponse_categorie($c['id']) ?></td>
   </tr>
   <?php } ?>
</table>
