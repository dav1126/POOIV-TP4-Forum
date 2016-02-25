<?php

// Inclusion du fichier de configuration (qui définit des constantes)
include 'global/config.php';
session_start();

// Inclusion de Pdo2, potentiellement utile partout
include CHEMIN_LIB.'pdo2.php';

function utilisateur_est_connecte() {
	return !empty($_SESSION['id']);
}


include CHEMIN_MODELE.'membres.php';
// Le mec n'est pas connecté mais les cookies sont là, on y va !
if (!utilisateur_est_connecte() && !empty($_COOKIE['id']) && !empty($_COOKIE['connexion_auto'])){
	$infos_utilisateur = lire_infos_utilisateur($_COOKIE['id']);
	if (false !== $infos_utilisateur) {
		$navigateur = (!empty($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
			$hash=sha1('aaa'.$infos_utilisateur['nom_utilisateur'].'bbb'.$infos_utilisateur['mot_de_passe'].'ccc'.$navigateur.'ddd');
		if ($_COOKIE['connexion_auto'] == $hash) {
			// 	On enregistre les informations dans la session
			$_SESSION['id'] = $_COOKIE['id'];
			$_SESSION['pseudo'] = $infos_utilisateur['nom_utilisateur'];
			$_SESSION['avatar'] = $infos_utilisateur['avatar'];
			$_SESSION['email'] = $infos_utilisateur['adresse_email'];
		}//$_COOKIE['connexion_auto'] == $hash
	}//(false !== $infos_utilisateur)
}//(!utilisateur_est_connecte() && !empty($_COOKIE['id']

?>