<?php

// V�rification des droits d'acc�s de la page
if (utilisateur_est_connecte()) {
	// On affiche la page d'erreur comme quoi l'utilisateur est d�j� connect�
	include CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
} else {
	// Reste de la page comme avant
	function ajouter_membre_dans_bdd($nom_utilisateur, $mdp,$adresse_email, $hash_validation) {
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare("INSERT INTO membres SET
nom_utilisateur = :nom_utilisateur,
mot_de_passe = :mot_de_passe,
adresse_email = :adresse_email,
hash_validation = :hash_validation,
date_inscription = NOW()");
		$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
		$requete->bindValue(':mot_de_passe', $mdp); $requete->bindValue(':adresse_email', $adresse_email); $requete->bindValue(':hash_validation', "");
		if ($requete->execute()) {
			return $pdo->lastInsertId();
		}
		return $requete->errorInfo();
	}
}

?>