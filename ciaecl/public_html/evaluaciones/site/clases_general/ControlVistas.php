<?php

class ControlVistas extends ControlObjetos 
{
	var $obj; 	 
	 
	function ControlVistas($vista) 
	{			
		parent::ControlObjetos();
		$this->obj = new Objetos();  	
		$this->sourceTable = $vista;  
	}  
}

?>