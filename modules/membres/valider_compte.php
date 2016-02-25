<?php

// echo "<p>je passe</p>";

// V�rification des droits d'acc�s de la page
if (utilisateur_est_connecte ())
{
	// On affiche la page d'erreur comme quoi l'utilisateur est d�j� connect�
	include CHEMIN_VUE_GLOBALE . 'erreur_deja_connecte.php';
}
else
{
	// Reste de la page comme avant
	
	// On v�rifie qu'un hash est pr�sent
	if (! empty ( $_GET ['hash'] ))
	{
		// On veut utiliser le mod�le des membres (~/modeles/membres.php)
		include_once CHEMIN_MODELE . 'membres.php'; // C'�tait comment� dans le code de Pierre****************
		                                          // valider_compte_avec_hash() est d�finit dans ~/modeles/membres.php
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
