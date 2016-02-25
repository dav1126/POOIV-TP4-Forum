<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<title></title>
	</head>
<body>
<h2>Inscription au site</h2>
<?php
if (!empty($erreurs_inscription)) {
	echo '<ul>'."\n";
	foreach($erreurs_inscription as $e) {
		echo
		' <li>'.$e.'</li>'."\n"; 
	}
	echo '</ul>';
}
	echo $form_inscription;
?>
</body>
</html>