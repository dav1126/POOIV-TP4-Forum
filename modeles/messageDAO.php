<?php
function addMessage($forum_id, $user_id, $message)
{
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ( "insert into message values (null," .$user_id. ", null, STR_TO_DATE(NOW(), '%Y-%m-%d %H:%i:%s')," .$forum_id. ", '" .$message. "');");
	$success = $requete->execute();
	if (!$success)
		echo "false";
		else
			echo "true";
			return $success;
}

function addSubMessage($forum_id, $user_id, $message, $parent_msg_id)
{	
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ( "insert into message values (null," .$user_id. ", " .$parent_msg_id. ", STR_TO_DATE(NOW(), '%Y-%m-%d %H:%i:%s')," .$forum_id. ", '" .$message. "');");
	$success = $requete->execute();
	return $success;
}

/**
 * Gets all message records from the databse in chronological order 
 * @param $forum_titre : titre tu forum
 * @return array of all messages records in chronological order
 */
function readMessages($forum_titre)
{
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ("select messageID, membres_id, parent_messageID, horoDate, forum_ForumID, texte, nom_utilisateur from message join forum on ForumID = forum_ForumID join membres on membres.id = message.membres_id where forum.titre=:forum_titre order by horoDate;");
	$requete->bindParam(':forum_titre', $forum_titre);
	$success = $requete->execute ();
	if (!$success)
		echo "false";
	$result = $requete->fetchAll();
	return $result;
}

