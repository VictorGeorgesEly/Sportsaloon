<header class="header-basic-light">
        <div class="header-limiter">
          <h1><a href="index.php"><img class="imageheader" style="margin-top:-15px;" src="IMG/Sportsaloon1.png" alt="" /></a></h1>
          <nav>
            <?php if(isAdmin($_SESSION['sportsaloon']['pseudonyme'])){?>
            <a href="admin/accueil.php">Panneau administrateur</a>
            <?php } ?>
      			<a href="Groupe.php">Groupes de sport</a>
            <a href="forum.php">Forum</a>
            <a href="faq.php">Aide</a>
            <?php if(isset($_SESSION['sportsaloon'])){?>
            <a href="Messagerie.php">Messagerie privée</a>
            <?php } if(isset($_SESSION['sportsaloon'])){ ?>
            <a href="profil.php">Profil</a>
            <?php } if(isset($_SESSION['sportsaloon'])){ ?>
              <a href="deconnexion.php">Deconnexion</a>
            <?php }
            else { ?>
              <a href="connection.php">Connexion et inscription</a>
            <?php } ?>
		      </nav>
	       </div>
</header>
