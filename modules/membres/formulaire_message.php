<?php 
include_once CHEMIN_LIB . 'form.php';

$nom_forum =  $_POST['nom_forum'];
$forumID = $_POST['id_forum'];
$user_id = $_SESSION['id'];

if (isset($_POST['message']))
{
	$messageID = $_POST['messageID'];
}

if (isset($_POST['commentaire']))
{
	include_once CHEMIN_MODELE . 'forumDAO.php';
	include_once CHEMIN_MODELE . 'messageDAO.php';
	
	$reponse = $_POST['nouveauMessage'];
	if (isset($_POST['parent_messageID']))
	{
		$parent_messageID = $_POST['parent_messageID'];
		addSubMessage($forumID, $user_id, $reponse, $parent_messageID);
	}
	else 
	{
		addMessage($forumID, $user_id, $reponse);
	}
	
	echo '<p class="commentaire">';
	echo $_POST['commentaire'];
	echo '</p>';
	
	$revenirButton = new Form('revenir');
	$revenirButton->method('POST');
	$revenirButton->action('index.php?module=membres&action=choix_forum');
	$revenirButton->add('Hidden', 'forum')->value($nom_forum);
	$revenirButton->add('Submit', 'cancelReponse') ->value("Revenir au forum");
	
	echo $revenirButton;
	
}

else
{
	if (isset($_POST['message']))
	{
		echo '<p>Reponse a: ' . $_POST['message'] . '</p><br/>';
		$repondreButton = new Form('repondre_form');
		$repondreButton->method('POST');
		$repondreButton->add('Hidden', 'nom_forum')->value($nom_forum);
		$repondreButton->add('Hidden', 'messageID')->value($messageID);
		$repondreButton->add('Hidden', 'id_forum')->value($forumID);
		$repondreButton->add('Hidden', 'commentaire')->value('Reponse ajoutee');
		if	(isset($_POST['parent_messageID']))
			$repondreButton->add('Hidden', 'parent_messageID')->value($_POST['parent_messageID']);
		$repondreButton->add('Textarea', 'nouveauMessage')->label('Message')->cols(100)->rows(10);
		$repondreButton->add('Submit', 'submitReponse') ->value("Repondre");
		
		echo $repondreButton;
		
		$repondreButtonAnnuler = new Form('repondre_annuler');
		$repondreButtonAnnuler->method('POST');
		$repondreButtonAnnuler->action('index.php?module=membres&action=choix_forum');
		$repondreButtonAnnuler->add('Hidden', 'forum')->value($nom_forum);
		$repondreButtonAnnuler->add('Submit', 'cancelReponse') ->value("Annuler");
		
		echo $repondreButtonAnnuler;
	}
	
	else 
	{
		echo '<p class = forumTitle>Nouveau message</p><br/>';
		
		$publierButton = new Form('repondre_form');
		$publierButton->method('POST');
		$publierButton->add('Hidden', 'nom_forum')->value($nom_forum);
		$publierButton->add('Hidden', 'id_forum')->value($forumID);
		$publierButton->add('Hidden', 'commentaire')->value('Message ajoutee');
		$publierButton->add('Textarea', 'nouveauMessage')->label('Message')->cols(100)->rows(10);
		$publierButton->add('Submit', 'submitReponse') ->value("Publier");
	
		echo $publierButton;
	
		$publierButtonAnnuler = new Form('repondre_annuler');
		$publierButtonAnnuler->method('POST');
		$publierButtonAnnuler->action('index.php?module=membres&action=choix_forum');
		$publierButtonAnnuler->add('Hidden', 'forum')->value($nom_forum);
		$publierButtonAnnuler->add('Submit', 'cancelReponse') ->value("Annuler");
	
		echo $publierButtonAnnuler;
	}
}

