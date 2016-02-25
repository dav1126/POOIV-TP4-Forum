<?php
if (empty ( $_GET ['id'] ) or ! is_numeric ( $_GET ['id'] ))
{
	include CHEMIN_VUE . 'erreur_parametre_profil.php';
}
else
{
	// On veut utiliser le modèle des membres (~/modules/membres.php)
	include_once CHEMIN_MODELE . 'membres.php';
	// lire_infos_utilisateur() est défini dans ~/modules/membres.php
	$infos_utilisateur = lire_infos_utilisateur ( $_GET ['id'] );
	// Si le profil existe et que le compte est validé
	if (false !== $infos_utilisateur && $infos_utilisateur ['hash_validation'] == '')
	{
		//**************MODIFICATION DU CODE D'ORIGINE: //lire_infos_utilisateur renvoie un tableau associatif, alors que list fonctionne avec des tableau a indexation numerique...on doit modifier le code pour lire dans un tableau associatif
		$nom_utilisateur = $infos_utilisateur ['nom_utilisateur'];
		$adresse_email = $infos_utilisateur ['adresse_email'];
		$date_inscription = $infos_utilisateur ['date_inscription']; 
		
		include CHEMIN_VUE . 'profil_infos_utilisateur.php';
	}
	else
	{
		include CHEMIN_VUE . 'erreur_profil_inexistant.php';
	}
}
?>