<?php

include CHEMIN_LIB.'form.php';

$form_inscription = new Form('formulaire_inscription');
$form_inscription->method('POST');
$form_inscription->add('Text', 'nom_utilisateur')->label("Votre nom d'utilisateur");
$form_inscription->add('Password', 'mdp') ->label("Votre mot de passe");
$form_inscription->add('Password', 'mdp_verif')->label("Votre mot de passe (vérification)");
$form_inscription->add('Email', 'adresse_email')->label("Votre adresse email");
$form_inscription->add('Submit', 'submit') ->value("Je veux m'inscrire !");

// Pr�-remplissage avec les valeurs pr�c�demment entr�es (s'il y en a)
$form_inscription->bound($_POST);
// Cr�ation d'un tableau des erreurs
$erreurs_inscription = array();

//Validation des champs suivant les r�gles en utilisant les donn�es du tableau $_POST
if ($form_inscription->is_valid($_POST)) {
	//On v�rifie si les 2 mots de passe correspondent
	if ($form_inscription->get_cleaned_data('mdp') !=
			$form_inscription->get_cleaned_data('mdp_verif')) {
				$erreurs_inscription[] = "Les deux mots de passes entrés sont différents !";
			}

			// Si d'autres erreurs ne sont pas survenues
			if (empty($erreurs_inscription)) {

				$hash_validation = md5(uniqid(rand(), true));
				list($nom_utilisateur, $mot_de_passe, $adresse_email, $avatar) =
				$form_inscription->get_cleaned_data('nom_utilisateur', 'mdp','adresse_email', 'avatar');
				include CHEMIN_MODELE.'inscription.php';
				
				// ajouter_membre_dans_bdd() est d�fini dans ~/modeles/inscription.php
				$id_utilisateur = ajouter_membre_dans_bdd($nom_utilisateur,
						sha1($mot_de_passe), $adresse_email, $hash_validation);
				// Si la base de donn�es a bien voulu ajouter l'utlilisateur (pas doublons)
				if (ctype_digit($id_utilisateur)) {
						$id_utilisateur = (int) $id_utilisateur;
					
						// Preparation du mail
						$message_mail = '<html><head></head><body>
						<p>Veuillez cliquer sur <a href="'.$_SERVER['PHP_SELF'].'?
						module=membres&amp;action=valider_compte&amp;hash='.$hash_validation.'">ce
						lien</a> pour activer votre compte !</p>
						</body></html>';
						$headers_mail = 'MIME-Version: 1.0' ."\r\n";
						$headers_mail .= 'Content-type: text/html; charset=utf-8' ."\r\n";
						$headers_mail .= 'From: "Mon site" <contact@monsite.com>' ."\r\n";
						// Envoi du mail
						if ($pointeurFichier = fopen (CHEMIN_INSCRIPTION . $id_utilisateur . "-" . $hash_validation .
								".html", "w"))
						{
							if (!fwrite ($pointeurFichier, $message_mail . $headers_mail) === FALSE)
							{
								$erreurs_inscription [] = "Impossible d'écrire dans le fichier (" .
										CHEMIN_INSCRIPTION . $id_utilisateur . "-" . $hash_validation . ".html)";
							}
						}
						else
						{
							$erreurs_inscription [] = "Impossible d'ouvrir le fichier (" . CHEMIN_INSCRIPTION .
							$id_utilisateur . "-" . $hash_validation . ".html)";
						}
						// Affichage de la confirmation de l'inscription
						include CHEMIN_VUE.'inscription_effectuee.php';
						// Gestion des doublons
						} else {
							// Changement de nom de variable (plus lisible)
							$erreur =& $id_utilisateur;
							// On v�rifie que l'erreur concerne bien un doublon
						if (23000 == $erreur[0]) { // Le code d'erreur 23000 siginife "doublon" dans le standard ANSI SQL
						if (strpos ($erreur [2], $adresse_email) !== false)
						{
							$erreurs_inscription [] = "Cette adresse e-mail est déjà utilisée.";
						}
						else if (strpos ($erreur [2], $nom_utilisateur) !== false)
						{
							$erreurs_inscription [] = "Ce nom d'utilisateur est déjà utilisé.";
						}
						else
						{
							$erreurs_inscription [] = "Erreur ajout SQL : doublon non identifié présent dans la base de données.";
						}
						
				
						} else {
							$erreurs_inscription[] = sprintf("Erreur ajout SQL : cas non traité
							(SQLSTATE = %d).", $erreur[0]);
						}
						// On reaffiche le formulaire d'inscription
						include CHEMIN_VUE.'formulaire_inscription.php';
						}
				
			} else {
					
				// On affiche � nouveau le formulaire d'inscription
				include CHEMIN_VUE.'formulaire_inscription.php';
			}
} else {
	// On affiche � nouveau le formulaire d'inscription
	include CHEMIN_VUE.'formulaire_inscription.php';
}

?>
