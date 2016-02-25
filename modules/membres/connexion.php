<?php

// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {
	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté
	include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
} else {
	// Reste de la page comme avant

include CHEMIN_LIB.'form.php';
$form_connexion = new Form('formulaire_connexion');
$form_connexion->method('POST');
$form_connexion->add('Text', 'nom_utilisateur') ->label("Votre nom d'utilisateur");
$form_connexion->add('Text', 'mot_de_passe')->label("Votre mot de passe");
$form_connexion->add('Submit', 'submit') ->value("Connectez-moi !");
// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
$form_connexion->bound($_POST);


//Création d'un tableau des erreurs
$erreurs_connexion = array();
// Validation des champs suivant les règles 
if ($form_connexion->is_valid($_POST)) {
list($nom_utilisateur, $mot_de_passe) =
	$form_connexion->get_cleaned_data('nom_utilisateur','mot_de_passe');
	
	// On veut utiliser le modèle des membres (~/modeles/membres.php)
	//***** IMPORTANT ***** 
	include_once CHEMIN_MODELE.'membres.php'; //******************************C'était commenté dans la version de Pierre
	
	//combinaison_connexion_valide() est définit dans ~/modeles/membres.php
	$id_utilisateur = combinaison_connexion_valide($nom_utilisateur,sha1($mot_de_passe));
	
	// Si les identifiants sont valides
	if (false !== $id_utilisateur) {
		$infos_utilisateur = lire_infos_utilisateur($id_utilisateur);
		// On enregistre les informations dans la session
		$_SESSION['id'] = $id_utilisateur;
		$_SESSION['pseudo'] = $nom_utilisateur;
		$_SESSION['email'] = $infos_utilisateur['adresse_email'];
		
		// Affichage de la confirmation de la connexion
		include CHEMIN_VUE.'connexion_ok.php';
	} else {
		$erreurs_connexion[] = "Couple nom d'utilisateur / mot de passe
		inexistant.";
		// On réaffiche le formulaire de connexion
		include CHEMIN_VUE.'formulaire_connexion.php';
		}
} else {
	// On réaffiche le formulaire de connexion
	include CHEMIN_VUE.'formulaire_connexion.php';
}

}
?>
