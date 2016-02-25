<?php

function maj_avatar_membre($id_utilisateur , $avatar) {
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare("UPDATE membres SET
	avatar = :avatar
	WHERE
	id = :id_utilisateur");
	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->bindValue(':avatar', $avatar);
	return $requete->execute();	
}

function valider_compte_avec_hash($hash_validation) {
	//echo "<p>je passe</p>";
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare("UPDATE membres SET
hash_validation = ''
WHERE
hash_validation = :hash_validation");
	$requete->bindValue(':hash_validation', $hash_validation);
	$requete->execute();
	return ($requete->rowCount() == 1);
}

function lire_infos_utilisateur($id_utilisateur) {
	$pdo = PDO2::getInstance();
	$requete = $pdo->prepare("SELECT nom_utilisateur, mot_de_passe,
adresse_email, date_inscription, hash_validation
FROM membres
WHERE
id = :id_utilisateur");
	$requete->bindValue(':id_utilisateur', $id_utilisateur);
	$requete->execute();
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) { 
		$requete->closeCursor();
		return $result;
	}
	return false;
}

function combinaison_connexion_valide($nom_utilisateur,
		$mot_de_passe) {
			$pdo = PDO2::getInstance();
			$requete = $pdo->prepare("SELECT id FROM membres
WHERE
nom_utilisateur = :nom_utilisateur AND
mot_de_passe = :mot_de_passe AND
hash_validation = ''");
			$requete->bindValue(':nom_utilisateur',$nom_utilisateur);
			//echo "<p>".$nom_utilisateur."</p>";
			$requete->bindValue(':mot_de_passe',$mot_de_passe);
			//echo "<p>".$mot_de_passe."</p>";
			$requete->execute();
			//echo "<p>".$requete->rowCount()."</p>";
			if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
				$requete->closeCursor();
				return $result['id'];
			}
			return false;
}

?>