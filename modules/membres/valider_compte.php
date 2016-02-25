<?php

// echo "<p>je passe</p>";

// Vérification des droits d'accès de la page
if (utilisateur_est_connecte ())
{
	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté
	include CHEMIN_VUE_GLOBALE . 'erreur_deja_connecte.php';
}
else
{
	// Reste de la page comme avant
	
	// On vérifie qu'un hash est présent
	if (! empty ( $_GET ['hash'] ))
	{
		// On veut utiliser le modèle des membres (~/modeles/membres.php)
		include_once CHEMIN_MODELE . 'membres.php'; // C'était commenté dans le code de Pierre****************
		                                          // valider_compte_avec_hash() est définit dans ~/modeles/membres.php
		if (valider_compte_avec_hash ( $_GET ['hash'] ))
		{
			// Affichage de la confirmation de validation du compte
			include CHEMIN_VUE . 'compte_valide.php';
		}
		else
		{
			// Affichage de l'erreur de validation du compte
			include CHEMIN_VUE . 'erreur_activation_compte.php';
		}
	}
	else
	{
		// Affichage de l'erreur de validation du compte
		include CHEMIN_VUE . 'erreur_activation_compte.php';
	}
}
?>
