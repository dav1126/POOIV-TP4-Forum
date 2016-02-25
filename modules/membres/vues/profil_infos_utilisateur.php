<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

		<title></title>
	
	</head>
<body>
<h2>Profil de <?php echo htmlspecialchars($nom_utilisateur); ?></h2>
<p>
<span class="label_profil">Adresse email</span> : <?php echo
htmlspecialchars($adresse_email); ?><br />
<span class="label_profil">Date d'inscription</span> : <?php echo
$date_inscription; ?>
</p>
</body>
</html>