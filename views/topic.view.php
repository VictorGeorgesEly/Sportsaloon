<table class="forum">
   <tr class="header">
      <th class="sub-info w10">Auteur</th>
      <th class="main center">Sujet: <?= $topic['sujet'] ?></th>
   </tr>
   <?php if($pageCourante == 1) { ?>
   <tr>
      <td><?= $topic['id_createur'] ?></td>
      <td>
         <?php
         $parser->parse($topic['contenu']);
         // Ou plutôt $parser->parse(nl2br($topic['contenu'])); afin de conserver les retours à la ligne !
         echo $parser->getAsHtml();
         ?>
      </td>
   </tr>
   <?php } ?>
   <?php while($r = $reponses->fetch()) { ?>
   <tr>
      <td><?= $r['id_posteur'] ?></td>
      <td><?= $r['contenu'] ?></td>
   </tr>
   <?php } ?>
</table>
<div class="">
<?php
  for($i=1;$i<=$pagesTotales;$i++) {
     if($i == $pageCourante) {
        echo $i.' ';
     } else {
        echo '<a href="topic.php?titre='.$get_titre.'&id='.$get_id.'&page='.$i.'">'.$i. '</a> ';
     }
  }
 ?>
 </div>
<br />
<?php if(isset($_SESSION['sportsaloon'])) { ?>
   <form method="POST">
      <textarea class="form-control1" placeholder="Votre réponse" name="topic_reponse" style="width:80%"><?php if(isset($reponse)) { echo $reponse; } ?></textarea><br />
      <input class="boutton" type="submit" name="topic_reponse_submit" value="Poster ma réponse"></form>
   </form>
   <?php if(isset($reponse_msg)) { echo $reponse_msg; } ?>
<?php } else { ?>
   <p>Veuillez vous connecter ou créer un compte pour poster une réponse</p>
<?php } ?>
