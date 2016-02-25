<?php
class Forum
{
	var $titre;
	var $id;
	var $mainMessageArray;
	
	function __construct($titre)
	{
		$this->titre = $titre;
		$this ->mainMessageArray = array();
	}
	
	function __construct($titre, $id, $mainMessageArray)
	{
		$this->titre = $titre;
		$this->$id = $id;
		$this ->mainMessageArray = $mainMessageArray;
	}
	
	function getTitre()
	{
		return $this->titre;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function getMainMessageArray()
	{
		return $this->mainMessageArray;
	}
}
