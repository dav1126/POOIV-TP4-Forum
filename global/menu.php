<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title></title>
</head>
<body>

	<div id="menu">
		<h2>Menu</h2>

		<ul>
			<li><a href="index.php">Accueil</a></li>
		</ul>

		<h3>Espace membre</h3>
	
	<?php if (!utilisateur_est_connecte()) { ?>
	<ul>
			<li><a href="index.php?module=membres&amp;action=inscription">Inscription</a></li>
			<li><a href="index.php?module=membres&amp;action=connexion">Connexion</a></li>
		</ul>
<?php } else { ?>
<p>Bienvenue, <?php echo htmlspecialchars($_SESSION['pseudo']); ?>.</p>
		<ul>
			<li><a href="index.php?module=membres&amp;action=deconnexion">Déconnexion</a></li>
			<li><a
				href="index.php?module=membres&amp;action=afficher_profil&amp;id=<?php echo $_SESSION['id'] ?>">Afficher le profil</a></li>
			<li><a
				href="index.php?module=membres&amp;action=choix_forum">Forums</a></li>
		</ul>
<?php } ?>
	
</div>
	<!-- id menu -->

	</div>
	<!-- id centre (dans le fichier haut.php)-->

	<!-- 
<div id="bas">
	Tutoriel basé sur le tutoriel de
	Savageman pour le cours 420-306
</div>
 -->

</body>

</html>