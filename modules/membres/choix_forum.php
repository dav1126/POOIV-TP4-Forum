<?php
// On veut utiliser les ressources de classes modeles permettant d'aller chercher
//l'info sur les forums dans la BD
include_once CHEMIN_MODELE . 'forumDAO.php';
include_once CHEMIN_MODELE . 'messageDAO.php';
include_once CHEMIN_LIB . 'form.php';
// aller chercher les choix de forum
$forums = getForumsNames();

$form_choix_forums = new Form('choix_forum');
$form_choix_forums->method('POST');
$form_choix_forums->action('index.php?module=membres&action=choix_forum');

foreach ($forums as $forum)
{
	$choix [$forum['titre']] = $forum['titre'];
}

$form_choix_forums->add('Radio', 'forum')->choices($choix);
$form_choix_forums->add('Submit', 'submit') ->value("OK");


include CHEMIN_VUE . 'afficher_choix_forum.php';

if (isset($_POST['forum']))
{
	$nom_forum = $_POST['forum'];
	$forumID = getForumID($nom_forum);
	$messages = readMessages($nom_forum);
	$messagesTree = getMessagesTree($messages);

	echo '<div class = "forumTitle">';
	echo 'Forum '  . $nom_forum = $nom_forum;
	echo '</div><br/>';
	
	$repondreButton = new Form('nouveau_message');
	$repondreButton->method('POST');
	$repondreButton->action('index.php?module=membres&action=formulaire_message');
	$repondreButton->add('Hidden', 'nom_forum')->value($nom_forum);
	$repondreButton->add('Hidden', 'id_forum')->value($forumID);
	$repondreButton->add('Submit', 'nouveau_message') ->value("Nouveau message");
	echo $repondreButton;
	
	$messageView = "";
	foreach ($messagesTree as $element)
	{
		$mainMessage = $element;
		
		$repondreButton = new Form('repondre_button' . $mainMessage['messageRecord']['messageID']);
		$repondreButton->method('POST');
		$repondreButton->action('index.php?module=membres&action=formulaire_message');
		$repondreButton->add('Hidden', 'messageID')->value($mainMessage['messageRecord']['messageID']);
		$repondreButton->add('Hidden', 'message')->value($element['messageRecord']['texte']);
		$repondreButton->add('Hidden', 'nom_forum')->value($nom_forum);
		$repondreButton->add('Hidden', 'id_forum')->value($forumID);
		$repondreButton->add('Hidden', 'parent_messageID')->value($element['messageRecord']['messageID']);
		$repondreButton->add('Submit', 'submitReponse') ->value("Repondre");

		include CHEMIN_VUE . 'afficher_message.php';
		
		if (array_key_exists('childrens', $element))
		{	
			foreach ($element['childrens'] as $children)
			{
				readTree($children, $nom_forum, $forumID);
			}
		}
		include CHEMIN_VUE . 'afficher_message_fin.php';
	}		
}

function readTree($element, $nom_forum, $forumID)
{
	$child = $element;
	$repondreButton = new Form('repondre_button' . $element['messageRecord']['messageID']);
	$repondreButton->method('POST');
	$repondreButton->action('index.php?module=membres&action=formulaire_message');
	$repondreButton->add('Hidden', 'messageID')->value($element['messageRecord']['messageID']);
	$repondreButton->add('Hidden', 'message')->value($element['messageRecord']['texte']);
	$repondreButton->add('Hidden', 'nom_forum')->value($nom_forum);
	$repondreButton->add('Hidden', 'id_forum')->value($forumID);
	$repondreButton->add('Submit', 'submitReponse') ->value("Repondre");
	$repondreButton->add('Hidden', 'parent_messageID')->value($element['messageRecord']['messageID']);
	include CHEMIN_VUE . 'afficher_sous_messages.php';
	if (!empty($child['childrens']))
	{
		foreach($child['childrens'] as $element)
		{
			readTree($element, $nom_forum, $forumID);
		}
	}
	echo "</div>";
}



