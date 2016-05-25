-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Mar 12 Avril 2016 à 14:54
-- Version du serveur :  5.5.41-log
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sportsaloon`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

CREATE TABLE IF NOT EXISTS `adresse` (
`idadresse` int(11) NOT NULL,
  `numero_rue` int(11) NOT NULL,
  `type_rue` varchar(45) NOT NULL,
  `nom_rue` varchar(255) NOT NULL,
  `code_postal` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `aide_en_ligne`
--

CREATE TABLE IF NOT EXISTS `aide_en_ligne` (
`idquestion` int(11) NOT NULL,
  `question` text NOT NULL,
  `reponse` text NOT NULL,
  `date_publi` date NOT NULL,
  `heure_publi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `club`
--

CREATE TABLE IF NOT EXISTS `club` (
`idclub` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `avis` int(11) NOT NULL,
  `nombre_max_participants` int(11) NOT NULL,
  `id_adresse` int(11) NOT NULL,
  `id_sports` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `destinataire`
--

CREATE TABLE IF NOT EXISTS `destinataire` (
  `id_utilisateur` int(11) NOT NULL,
  `idmessage_prive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
`idevenement` int(11) NOT NULL,
  `nom_evenement` varchar(255) NOT NULL,
  `date_evenement` date NOT NULL,
  `heure_evenement` time NOT NULL,
  `nombre_max_participants` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL,
  `id_adresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE IF NOT EXISTS `groupe` (
`idgroupe` int(11) NOT NULL,
  `nom_groupe` varchar(255) NOT NULL,
  `nombre_max_participants` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `id_sports` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre_club`
--

CREATE TABLE IF NOT EXISTS `membre_club` (
`idmembre_club` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_club` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre_groupe`
--

CREATE TABLE IF NOT EXISTS `membre_groupe` (
`idmembre_groupe` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`idmessage` int(11) NOT NULL,
  `contenu` text NOT NULL,
  `date_publi` date NOT NULL,
  `heure_publi` time NOT NULL,
  `id_sujet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `message_prive`
--

CREATE TABLE IF NOT EXISTS `message_prive` (
`idmessage_prive` int(11) NOT NULL,
  `date_envoi` date NOT NULL,
  `heure_envoi` time NOT NULL,
  `contenu` text NOT NULL,
  `nom_destinataire` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `participe_evenement`
--

CREATE TABLE IF NOT EXISTS `participe_evenement` (
`idparticipe_evenement` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_evenement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sports`
--

CREATE TABLE IF NOT EXISTS `sports` (
`idsports` int(11) NOT NULL,
  `nom_sport` varchar(255) NOT NULL,
  `description_sport` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `sports`
--

INSERT INTO `sports` (`idsports`, `nom_sport`, `description_sport`) VALUES
(1, 'Football', 'Sport opposant deux équipes de onze joueurs dont chacune s''efforce d''envoyer un ballon de forme sphérique à l''intérieur du but adverse en le frappant et le dirigeant principalement du pied, éventuellement de la tête ou du corps, mais sans aucune intervention des mains que seuls les gardiens de but peuvent utiliser.'),
(2, 'Basketball', 'Le basketball, fréquemment désigné en français par son abréviation basket, est un sport collectif opposant deux équipes de cinq joueurs sur un terrain rectangulaire. L''objectif de chaque équipe est de faire passer un ballon au sein d''un arceau de 46 cm de diamètre, fixé à un panneau et placé à 3,05 m du sol : le panier. Chaque panier inscrit rapporte deux points à son équipe, à l''exception des tirs effectués derrière la ligne des trois points et des lancers francs accordés à la suite d''une faute, qui ne rapportent qu''un seul point. L''équipe avec le nombre de points le plus important remporte la partie.'),
(3, 'Handball', 'Le handball est un sport collectif où deux équipes de sept joueurs s''affrontent avec un ballon sur un terrain rectangulaire de dimensions 40 m par 20 m, séparé en deux camps. L''équipe gagnante est celle qui comptabilise le plus de buts à la fin du temps réglementaire (60 minutes). Chaque but s''obtient en faisant pénétrer le ballon dans la cage du but adverse (entre les poteaux et derrière la ligne de but).'),
(4, 'Volleyball', 'Le volleyball est un sport collectif mettant en jeu deux équipes de six joueurs séparés par un filet, qui s''affrontent avec un ballon sur un terrain rectangulaire de 18 mètres de long sur 9 mètres de large. Les points sont marqués soit en faisant tomber le ballon sur le terrain de l''équipe adverse, soit quand l''adversaire commet une faute. La première équipe à atteindre 25 points (avec 2 points d''écart minimum) gagne le set et la première équipe qui gagne trois sets gagne le match. '),
(5, 'Tennis', 'Le tennis est un sport de raquette qui oppose soit deux joueurs (on parle alors de jeu en simple) soit quatre joueurs qui forment deux équipes de deux (on parle alors de jeu en double).  Le but du jeu est de frapper la balle de telle sorte que l''adversaire ne puisse la remettre dans les limites du terrain, soit en marquant le point en mettant l''adversaire hors de portée de la balle, soit en l''obligeant à commettre une faute (si sa balle ne retombe pas dans les limites du court, ou si elle ne passe pas le filet).\r\nLe nombre de sets (ou manches) nécessaires pour gagner un match varie selon plusieurs critères (comme le sexe, l''âge ou le tournoi). Les limites du terrain et certaines règles sont différentes pour les matchs de simple et de double.'),
(6, 'Tennis de table', 'Sport qui consiste, pour deux ou quatre joueurs munis de raquettes, à envoyer une balle par-dessus un filet et qui se joue sur une table de dimensions standardisées. Le tennis de table (« ping-pong » dans le langage commun) est un sport de raquettes créé en Angleterre à la fin du XIXe siècle. Il s''agit d''un des sports les plus pratiqués au monde. '),
(7, 'Baseball', 'Le baseball est un sport d’équipe qui se joue avec des battes pour frapper une balle lancée et des gants pour rattraper la balle. C''est le sport national aux Etats-Unis, dérivé du cricket. Neuf joueurs se trouvent sur le terrain en défense : un lanceur, un receveur et sept autres joueurs (quatre dans le champ intérieur : première base, deuxième base, arrêt-court, troisième base, et trois dans le champ extérieur : champ droit, champ centre et champ gauche) répartis sur le terrain pour rattraper la balle, si possible de volée pour éliminer le batteur.'),
(8, 'Cricket', 'Le cricket est un sport collectif de balle et de batte opposant deux équipes composées normalement de onze joueurs chacune. Il se joue généralement sur un terrain de forme ovale, en herbe, au centre duquel se trouve une zone d''une vingtaine de mètres de longueur, à chaque extrémité de laquelle on trouve une structure de bois, le guichet. Une rencontre est divisée en plusieurs manches. Au cours de chacune d''entre elles, l''une des équipes essaye de marquer des points (courses), et possède simultanément deux batteurs sur le terrain, chacun devant l''un des guichets. Un point est notamment marqué à chaque échange de position de ces deux joueurs lorsque la balle est en jeu. Leurs onze adversaires sont également présents sur l''aire de jeu. La balle est lancée par l''un de ceux-ci en direction du guichet d''un des deux batteurs. L''objectif de la seconde équipe est d''empêcher la première de marquer, principalement en éliminant les batteurs adverses, par exemple en détruisant le guichet avec la balle sur le lancer.'),
(9, 'Rugby à XV', 'Le rugby à XV, aussi appelé rugby union dans les pays anglophones, qui se joue par équipes de quinze joueurs sur le terrain plus les remplaçants à l''extérieur, est la variante la plus pratiquée du rugby, famille de sports collectifs, dont les spécificités, outre ses quinze joueurs, sont les mêlées et les touches, mettant aux prises deux équipes qui se disputent un ballon ovale, joué à la main et au pied. L''objectif du jeu est de marquer plus de points que l''adversaire, en marquant soit des essais, soit des buts à travers les pénalités, soit des drops. De nos jours, un essai vaut cinq points et sept s''il est transformé, un drop ou une pénalité réussie valent trois points.'),
(10, 'Rugby à XIII', 'Le rugby à XIII, appelé rugby league dans les pays anglophones, est un sport collectif opposant deux équipes de treize joueurs qui se disputent un ballon ovale dans un stade. L''objectif est de marquer plus de points que son adversaire, soit à la main en marquant des essais, soit au pied en marquant des pénalités. Le but du rugby à XIII est de marquer plus de points que son adversaire avant la fin d''un temps imparti.'),
(11, 'Badminton', 'Le badminton est un sport de raquette qui oppose soit deux joueurs ou joueuses (simples), soit deux paires (doubles), placés dans deux demi-terrains séparés par un filet. Les joueurs et joueuses, appelés badistes, marquent des points en frappant un volant à l''aide d''une raquette pour le faire tomber dans le demi-terrain adverse. L''échange se termine dès que le volant touche le sol, ou s''il y a faute. Un match se joue au meilleur de 3 sets de 21 points chacun : le joueur ou l''équipe qui remporte 2 sets, gagne le match. Celui qui gagne un échange ajoute un point à son score.\r\nÀ 20-20, le set est prolongé : le camp qui mène avec 2 points d''écart remporte le set.'),
(12, 'Beach Soccer\r\n', 'Le football de plage, soccer de plage (Congo) ou beach soccer est un sport qui s''apparente au football et qui se pratique sur du sable de plage. Il met aux prises deux équipes de cinq joueurs, avec des remplacements fréquents, sur un terrain à peu près trois fois plus petit que celui du football. Le football de plage oppose deux équipes de cinq joueurs chacune, dont un gardien de but, qui ont droit à cinq remplaçants. Les remplacements sont en nombre illimité et peuvent intervenir à tout moment. Les chaussures sont interdites. '),
(13, 'Beach Volley', 'Le beach-volley est un sport collectif opposant deux équipes composées de deux joueurs, séparées par un filet, s''affrontant avec un ballon qu''ils se renvoient à l''aide des mains. Quoique dérivé du volleyball, le beach-olley en diffère par le fait qu''il se joue en général à l''extérieur sur une plage (ou un terrain recouvert de sable) et que chaque équipe n''est composée que de deux joueurs. La France a toutefois une tradition de volley de plage, se jouant avec des équipes de 3 ou 4 joueurs.'),
(14, 'Bowling', 'Le bowling, également appelé jeu de boules, jeu de quilles ou simplement quilles au Canada, est un jeu qui a été popularisé sous sa forme actuelle aux États-Unis et qui consiste à renverser des quilles à l''aide d''une boule.'),
(15, 'Hockey sur gazon', 'Le hockey sur gazon est un sport collectif de balle mettant aux prises deux formations de onze joueurs équipés d''une crosse (parfois appelée par sa dénomination anglaise "Stick"). Le hockey sur gazon met aux prises deux équipes de onze joueurs chacune sur un terrain de 91,40 mètres de long sur 55 mètres de large.\r\nUn match de hockey est constitué de 4 quart-temps de 15 minutes (FIH) ou de 17,5 minutes (Euro Hockey League).\r\nLa balle ne peut toucher que le côté plat de la crosse.\r\nLes joueurs ne peuvent toucher la balle avec aucune partie du corps, excepté le gardien.\r\nUn but est validé uniquement si la balle a été frappée ou déviée par un joueur quelconque situé dans le cercle avant de rentrer dans le but (le cercle est un demi-cercle de 16 m tracé à partir du centre du but).\r\nL''équipe gagnante est celle qui a marqué le plus de buts à la fin du temps réglementaire. Si les deux équipes ont marqué le même nombre de buts, alors le match est déclaré « match nul ».'),
(16, 'Hockey sur glace', 'Le hockey sur glace, appelé le plus souvent hockey, est un sport d’équipe se jouant sur une patinoire spécialement aménagée. L’objectif de chaque équipe est de marquer des buts en envoyant un disque de caoutchouc vulcanisé, appelé rondelle ou palet, à l’intérieur du but adverse situé à une extrémité de la patinoire. L’équipe se compose de plusieurs lignes de cinq joueurs, qui se relaient sur la glace, ainsi que d''un gardien de but, qui se déplacent en patins à glace et manipulent la rondelle à l’aide d’un bâton de hockey également appelée crosse en France ou canne de hockey en Belgique et en Suisse.'),
(17, 'Football US', 'Le football américain est un sport collectif opposant deux équipes de onze joueurs, où les deux équipes alternent entre la défense et l''attaque. Le but du jeu est de marquer des points en portant ou lançant le ballon jusqu''à la zone d''en-but adverse. Pour conserver la possession, l''équipe attaquante doit parcourir au moins 10 yards en 4 tentatives (appelées « down »). Dans le même temps, l''équipe en défense doit empêcher l''attaque d''atteindre cet objectif, dans le but de reprendre la possession de la balle. Si l''équipe attaquante valide 10 yards ou plus lors de sa possession, elle bénéficie de quatre nouvelles tentatives pour continuer à gagner du terrain. Sinon, la possession de la balle change de camp, et les rôles (défense/attaque) s''inversent.'),
(18, 'Softball', 'Le softball est un sport d''équipe pratiqué par deux équipes de 9 joueurs alternant entre l’attaque et la défense. Le but du jeu est de faire avancer les coureurs autour de quatre bases jusqu''au marbre et de marquer le plus de points possibles. Ce sport est un descendant direct du baseball. Le softball est pratiqué par les deux sexes de façon amateur ou compétitif. C''est un sport olympique pour les femmes seulement.'),
(19, 'Squash', 'Le squash est un sport de raquette qui se joue sur un terrain de jeu entièrement entouré de murs ou éventuellement de paroi(s) entièrement vitrée(s) pour permettre la présence de spectateurs lors des tournois internationaux. Il consiste à frapper une petite balle noire en caoutchouc, de telle sorte que son adversaire ne puisse pas la reprendre. Le but est donc d''éloigner le plus possible le joueur adverse du « T » central (là où se situe le joueur au short blanc sur l''image). À durées égales, le squash est l''un des sport les plus dépensiers en calories. L''autre particularité de ce sport est que les deux joueurs partagent et défendent alternativement la même surface de jeu. Cette spécificité met parfois les deux joueurs en interférence, on dit qu''il y a alors une situation de let.'),
(20, 'Pétanque', 'Jeu de boules originaire du midi de la France, dans lequel le but est de positionner ses boules le plus près possible d''un cochonnet, et qui se joue sur un terrain non préparé. C''est un sport principalement masculin (à titre d''exemple, seules 14% des licenciés sont des femmes en France). Néanmoins, c''est l''un des rares sports où des compétitions mixtes sont organisées. ');

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
`idsujet` int(11) NOT NULL,
  `nom_sujet` varchar(255) NOT NULL,
  `date_publi` date NOT NULL,
  `heure_publi` time NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `topic`
--

CREATE TABLE IF NOT EXISTS `topic` (
`idtopic` int(11) NOT NULL,
  `nom_topic` varchar(255) NOT NULL,
  `date_publi` date NOT NULL,
  `heure_publi` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
`idutilisateur` int(11) NOT NULL,
  `pseudonyme` varchar(45) NOT NULL,
  `mot_de_passe` varchar(45) NOT NULL,
  `numero_de_mobile` varchar(14) NOT NULL,
  `adresse_mail` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `derniere_connexion` date NOT NULL,
  `photo` varchar(255) NOT NULL,
  `verifie_admin` tinyint(1) NOT NULL,
  `id_adresse` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `adresse`
--
ALTER TABLE `adresse`
 ADD PRIMARY KEY (`idadresse`);

--
-- Index pour la table `aide_en_ligne`
--
ALTER TABLE `aide_en_ligne`
 ADD PRIMARY KEY (`idquestion`);

--
-- Index pour la table `club`
--
ALTER TABLE `club`
 ADD PRIMARY KEY (`idclub`), ADD KEY `id_adresse` (`id_adresse`,`id_sports`);

--
-- Index pour la table `destinataire`
--
ALTER TABLE `destinataire`
 ADD PRIMARY KEY (`id_utilisateur`,`idmessage_prive`), ADD KEY `idmessage_prive` (`idmessage_prive`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
 ADD PRIMARY KEY (`idevenement`), ADD KEY `id_groupe` (`id_groupe`,`id_adresse`), ADD KEY `id_adresse` (`id_adresse`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
 ADD PRIMARY KEY (`idgroupe`), ADD KEY `id_sports` (`id_sports`);

--
-- Index pour la table `membre_club`
--
ALTER TABLE `membre_club`
 ADD PRIMARY KEY (`idmembre_club`), ADD KEY `id_utilisateur` (`id_utilisateur`), ADD KEY `id_club` (`id_club`);

--
-- Index pour la table `membre_groupe`
--
ALTER TABLE `membre_groupe`
 ADD PRIMARY KEY (`idmembre_groupe`), ADD KEY `id_utilisateur` (`id_utilisateur`), ADD KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`idmessage`), ADD KEY `id_sujet` (`id_sujet`,`id_utilisateur`), ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `message_prive`
--
ALTER TABLE `message_prive`
 ADD PRIMARY KEY (`idmessage_prive`), ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `participe_evenement`
--
ALTER TABLE `participe_evenement`
 ADD PRIMARY KEY (`idparticipe_evenement`), ADD KEY `id_evenement` (`id_evenement`), ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `sports`
--
ALTER TABLE `sports`
 ADD PRIMARY KEY (`idsports`);

--
-- Index pour la table `sujet`
--
ALTER TABLE `sujet`
 ADD PRIMARY KEY (`idsujet`), ADD KEY `id_topic` (`id_topic`), ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `topic`
--
ALTER TABLE `topic`
 ADD PRIMARY KEY (`idtopic`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
 ADD PRIMARY KEY (`idutilisateur`), ADD KEY `id_adresse` (`id_adresse`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `adresse`
--
ALTER TABLE `adresse`
MODIFY `idadresse` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `aide_en_ligne`
--
ALTER TABLE `aide_en_ligne`
MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `club`
--
ALTER TABLE `club`
MODIFY `idclub` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
MODIFY `idevenement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groupe`
--
ALTER TABLE `groupe`
MODIFY `idgroupe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre_club`
--
ALTER TABLE `membre_club`
MODIFY `idmembre_club` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `membre_groupe`
--
ALTER TABLE `membre_groupe`
MODIFY `idmembre_groupe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
MODIFY `idmessage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `message_prive`
--
ALTER TABLE `message_prive`
MODIFY `idmessage_prive` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `participe_evenement`
--
ALTER TABLE `participe_evenement`
MODIFY `idparticipe_evenement` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sports`
--
ALTER TABLE `sports`
MODIFY `idsports` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `sujet`
--
ALTER TABLE `sujet`
MODIFY `idsujet` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `topic`
--
ALTER TABLE `topic`
MODIFY `idtopic` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
MODIFY `idutilisateur` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `destinataire`
--
ALTER TABLE `destinataire`
ADD CONSTRAINT `destinataire_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
ADD CONSTRAINT `destinataire_ibfk_2` FOREIGN KEY (`idmessage_prive`) REFERENCES `message_prive` (`idmessage_prive`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
ADD CONSTRAINT `adresse_of_event` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`idadresse`),
ADD CONSTRAINT `event_of_groupe` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`idgroupe`);

--
-- Contraintes pour la table `groupe`
--
ALTER TABLE `groupe`
ADD CONSTRAINT `sport_in_groupe` FOREIGN KEY (`id_sports`) REFERENCES `sports` (`idsports`);

--
-- Contraintes pour la table `membre_club`
--
ALTER TABLE `membre_club`
ADD CONSTRAINT `membre_club_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
ADD CONSTRAINT `membre_club_ibfk_2` FOREIGN KEY (`id_club`) REFERENCES `club` (`idclub`);

--
-- Contraintes pour la table `membre_groupe`
--
ALTER TABLE `membre_groupe`
ADD CONSTRAINT `membre_groupe_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
ADD CONSTRAINT `membre_groupe_ibfk_2` FOREIGN KEY (`id_groupe`) REFERENCES `groupe` (`idgroupe`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
ADD CONSTRAINT `message_in_sujet` FOREIGN KEY (`id_sujet`) REFERENCES `sujet` (`idsujet`);

--
-- Contraintes pour la table `message_prive`
--
ALTER TABLE `message_prive`
ADD CONSTRAINT `utilisateur_write_message` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `participe_evenement`
--
ALTER TABLE `participe_evenement`
ADD CONSTRAINT `participe_evenement_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`),
ADD CONSTRAINT `participe_evenement_ibfk_2` FOREIGN KEY (`id_evenement`) REFERENCES `evenement` (`idevenement`);

--
-- Contraintes pour la table `sujet`
--
ALTER TABLE `sujet`
ADD CONSTRAINT `sujet_in_topic` FOREIGN KEY (`id_topic`) REFERENCES `topic` (`idtopic`),
ADD CONSTRAINT `utilisateur_write_sujet` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`idutilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
ADD CONSTRAINT `adresse_utilisateur` FOREIGN KEY (`id_adresse`) REFERENCES `adresse` (`idadresse`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
