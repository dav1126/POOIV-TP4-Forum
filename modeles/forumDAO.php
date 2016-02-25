<?php
function getForums()
{
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ( "SELECT titre FROM forum ORDER BY titre");
	$requete->execute ();
	$result = $requete->fetchAll();
	return $result;
}

function getForumsNames()
{
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ( "SELECT titre FROM forum ORDER BY titre");
	$requete->execute ();
	$result = $requete->fetchAll();
	return $result;
}

function getForumID($name)
{
	$pdo = PDO2::getInstance ();
	$requete = $pdo->prepare ( 'SELECT ForumID FROM forum where titre=:name');
	$requete->bindParam(':name', $name);
	$requete->execute ();
	if ($result = $requete->fetch(PDO::FETCH_ASSOC)) { 
		$requete->closeCursor();
		return $result['ForumID'];
	}
	return false;
}

/**
 * Receives an array of messages records in chronological order and format them in a multidimensional array;
 * First Dimension: rootMessage Id ->
 * 		Second Dimension: 'messageRecord' -> bd record of the root message
 * 					      subMessages: ->
 * 			Third Dimension: subMessage ID ->
 * 				Fourth Dimension: 'messageRecord' -> bd record of the submessage
 * 					      		  'subMessages': ->
 * 					...
 * 					Last Dimension: bd Column1 Name -> bd Column1 Line1 record
 * 						 	 	  	bd Column2 Name -> bd Column2 Line1 record
 * 						 		    ...
 * @param $messages : array of messages records in chronological order
 */
function getMessagesTree($messages)
{
	ini_set('xdebug.var_display_max_depth', 6);
	$messagesTree = array();
	foreach($messages as $message)
	{
		if (is_null($message['parent_messageID']))
		{
			$array = build_tree($message['messageID'], $messages);
			if (!empty($array))
			{
				$messagesTree[$message['messageID']] ['childrens']= $array;
				$messagesTree[$message['messageID']]['messageRecord'] = $message;
			}
			else
			{
				$messagesTree[$message['messageID']]['messageRecord'] = $message;
			}
		}
	}
	//var_dump($messagesTree);
	return $messagesTree;
}

function build_tree($parent, $array)
{
	$tree = array();
	foreach ($array as $noeud) {
		if ($parent == $noeud['parent_messageID'])
		{
			$tree[$noeud['messageID']] = array(
					'messageRecord' => $noeud,
					'childrens' => build_tree($noeud['messageID'], $array)
			);
		}
	}
	return $tree;
}