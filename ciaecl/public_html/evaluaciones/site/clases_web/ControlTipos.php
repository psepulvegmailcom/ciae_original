<?php

class Universidad extends Objetos
{
	var $sourceTable =  'site_universidad';
	
	function Universidad()
	{ 
		parent::Objetos();
		$this->dbKey = 'id_universidad';
	} 
}
class ControlUniversidad extends ControlObjetos
{ 
	function ControlUniversidad()
	{
		parent::ControlObjetos();
		$this->obj 		= new Universidad();
		$this->order 	= 'orden ASC';  
		$this->key 			= $this->obj->dbKey;
		$this->sourceTable = $this->obj->sourceTable;
	} 
}

?>