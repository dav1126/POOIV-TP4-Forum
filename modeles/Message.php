<?php
class Message
{	
	var $id;
	var $membreId;
	var $texte;
	var $time;
	var $sousMessageArray;
	var $parentId;
	
	function __construct($texte, $membreId, $time)
	{
		$this->texte = $texte;
		$this->$membreId;
		$this->time = $time;
		$this->sousMessageArray = array();
		$this->$parentId = null;
	}
	
	function __construct($texte, $membreId, $time, $parentId)
	{
		$this->texte = $texte;
		$this->$membreId;
		$this->time = $time;
		$this->sousMessageArray = array();
		$this->$parentId = $parentId;
	}
	
	function __construct($id, $membreId, $texte, $time)
	{
		$this->id = $id;
		$this->$membreId;
		$this->texte = $texte;
		$this->time = $time;
		$this->sousMessageArray = array();
		$this->$parentId = null;
	}
	
	function __construct($id, $membreId, $texte, $time, $parentId)
	{
		$this->id = $id;
		$this->$membreId;
		$this->texte = $texte;
		$this->time = $time;
		$this->sousMessageArray = array();
		$this->$parentId = $parentId;
	}
	
	function __construct($id, $membreId, $texte, $time, $sousMessageArray, $parentId)
	{
		$this->id = $id;
		$this->$membreId;
		$this->texte = $texte;
		$this->time = $time;
		$this->sousMessageArray = $sousMessageArray;
		$this->$parentId = $parentId;
	}
	
	function addSubMessage($sousMessage)
	{
		array_push($this->sousMessageArray, $sousMessage);
	}
	
	function getSousMessageArray()
	{
		return $this->sousMessageArray;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function getTexte()
	{
		return $this->texte;
	}
	
	function getTime()
	{
		return $this->time;
	}
	
	function getParentId()
	{
		return $this->parentId;
	}
}