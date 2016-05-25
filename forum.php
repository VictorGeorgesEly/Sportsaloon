<?php
session_start();
require_once("fonctions/fonction.php");
require_once("fonctions/fonctionSQL.php");

$categories = connectBDD()->query('SELECT * FROM f_categories ORDER BY nom');
$subcat = connectBDD()->prepare('SELECT * FROM f_souscategories WHERE id_categorie = ? ORDER BY nom');

?>

<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="forum.css" />
		<link rel="stylesheet" href="stylesheet.css" />
		<title>Forum</title>
		<link rel="shortcut icon" href="IMG/favicon.ico">
	</head>

	<body>

  <?php include("header.php"); ?>

    <h1>Forum</h1>
		</br></br>
		<div class="inscriptionetconnexion">
			<br>
    <?php require('views/forum.view.php');?>
		<br>
		</div>
    <?php include("footer.php"); ?>

	</body>
</html>
